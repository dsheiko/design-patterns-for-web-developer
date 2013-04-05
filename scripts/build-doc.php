<?php
define("PATH_ROOT", realpath(__DIR__ . "/.."));

abstract class Convertor
{
    abstract public function convertLink($url, $content);
    abstract public function convertImg($url, $title);
    abstract public function convertCode($path, $lang);
    abstract public function convertVar($title);
    abstract public function convertSamp($title);
    abstract public function convertDfn($title);
    abstract public function convertBlockquote($content, $author, $title, $url);
    abstract public function convertParagraph($content);
    abstract public function convertLi($content);
    abstract public function convertHeader($lvl, $content);
}

class HtmlConvertor extends Convertor
{
    public function convertLink($url, $content)
    {
        return strtr('<a href="[url]">[content]</a>', array(
            "[url]" => $url,
            "[content]" => $content
        ));
    }
    public function convertImg($url, $title)
    {
        return strtr('<figure><img src="[url]" title="[title]" alt="[title]" /><figcaption>[title]</figcaption></figure>', array(
            "[url]" => $url,
            "[title]" => $title
        ));
    }
    public function convertCode($path, $lang)
    {
        $file = PATH_ROOT . "/" . ltrim($path, "./");
        $allowedLangs = array("js", "php", "bash", "xml", "java", "css", "plain");
        in_array($lang, $allowedLangs) || $lang = "plain";
        if (file_exists($file)) {
            $code = htmlentities(file_get_contents($file));
            return "\n<pre class=\"brush: {$lang}\">\n{$code}\n</pre>\n";
        } else {
            throw new Exception($path . " not found\n");
        }
    }
    public function convertVar($title)
    {
        return "<var>{$title}</var>";
    }
    public function convertSamp($title)
    {
        return "<samp>{$title}</samp>";
    }
    public function convertDfn($title)
    {
        return "<dfn>{$title}</dfn>";
    }
    public function convertBlockquote($content, $author, $title, $url)
    {
        return strtr('<blockquote cite="[url]">
<p>[quote]</p>
<footer>%26mdash; <cite><a title="[title]" href="[url]">[author]</a></cite></footer>
</blockquote>', array(
            "[url]" => $url,
            "[content]" => $content,
            "[author]" => $author,
            "[title]" => $title
        ));
    }
    public function convertParagraph($content)
    {
        return $content ? "\n<p>{$content}</p>\n" : "";
    }
    public function convertLi($content)
    {
        return $content ? "<li>{$content}</li>" : "";
    }
    public function getUlOpening()
    {
        return "\n<ul>\n";
    }
    public function getUlClosing()
    {
        return "</ul>\n";
    }
    public function convertHeader($lvl, $content)
    {
        return strtr("<h[lvl]>[content]</h[lvl]>", array(
            "[lvl]" => $lvl,
            "[content]" => $content
        ));
    }
}


abstract class Translator
{
    abstract public function translate($markup);
}
class BlockTranslator extends Translator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    /**
     * [link:url|title]
     * [img:url|title]
     * [code:path]
     * [var:title]
     * [dfn:title]
     * [samp:title]
     * [blockquote:content|author|title|url]
     *
     */
    public function translate($markup)
    {
        preg_match_all("/\[(\w+)\:(.*?)\]/s", $markup, $matches);
        if (!$matches[1]) {
            return $markup;
        }
        foreach ($matches[1] as $inx => $operator) {
            $method = "translate" . ucfirst($operator);

            if (method_exists($this, $method)) {
                $markup = str_replace($matches[0][$inx],
                    $this->$method($matches[2][$inx]),
                    $markup);
            }
        }
        return $markup;
    }
    public function translateLink($params)
    {
        list ($url, $content) = explode("|", $params);
        return $this->_convertor->convertLink($url, $content);
    }
    public function translateImg($params)
    {
        list ($url, $title) = explode("|", $params);
        return $this->_convertor->convertImg($url, $title);
    }
    public function translateCode($params)
    {
        list ($path, $lang) = explode("|", $params);
        return $this->_convertor->convertCode($path, $lang);
    }
    public function translateVar($params)
    {
        return $this->_convertor->convertVar($params);
    }
    public function translateSamp($params)
    {
        return $this->_convertor->convertSamp($params);
    }
    public function translateDfn($params)
    {
        return $this->_convertor->convertDfn($params);
    }
    public function translateBlockquote($params)
    {
        list ($content, $author, $title, $url) = explode("|", $params);
        return $this->_convertor->convertBlockquote($content, $author, $title, $url);
    }
}
class PerLineTranslator extends Translator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    public function translate($markup)
    {
        $indices = array();
        $lines = explode("\n", $markup);
        if (!$lines) {
            return $markup;
        }
        foreach ($lines as $inx => $line) {
            // Parse h{n}. header
            if (preg_match("/^\s*h(\d)\.(.*?)$/", $line, $matches)) {
                $lines[$inx] = $this->_convertor->convertHeader($matches[1], $matches[2]);
            }
            // Parse * list item
            if (preg_match("/^\s*\*/", $lines[$inx])) {
                $lines[$inx] = $this->_convertor->convertLi(
                    preg_replace("/^\s*\*/", "", $lines[$inx])
                );
                if (!isset($indices[$inx - 1])) {
                    $lines[$inx] = $this->_convertor->getUlOpening() . $lines[$inx];
                }
                $indices[$inx] = true;
            } else {
                if (isset($indices[$inx - 1])) {
                    $lines[$inx] = $lines[$inx] . $this->_convertor->getUlClosing();
                }
            }
        }
        if (isset($indices[$inx])) {
            $lines[$inx] = $this->_convertor->getUlClosing() . $lines[$inx];
        }
        return implode("\n", $lines);
    }
}
class ParagraphTranslator extends Translator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    public function translate($markup)
    {
        // CR+LF to LF
        $markup = preg_replace("/\r/s", "", $markup);
        // Remove trailing spaces
        $markup = preg_replace("/\n\s+\n/s", "\n\n", $markup);
        // Remove repeating EOL
        $markup = preg_replace("/\n{2}/s", "\n\n", $markup);
        $pars = explode("\n\n", $markup);
        $convertor = $this->_convertor;

        return array_reduce($pars, function($acc, $p) use($convertor) {
            $p = trim($p);
            $acc .= (strpos($p, "<") === 0 || strpos($p, "[") === 0) ?
                $p . PHP_EOL :
                $convertor->convertParagraph($p) ;
            return $acc;
        }, "");
    }
}
class Client
{
    static public function convert($markup)
    {
        $convertor = new HtmlConvertor();
        $translators = array(
            "PerLineTranslator",
            "ParagraphTranslator",
            "BlockTranslator",
        );
        foreach ($translators as $className) {
            $translator = new $className($convertor);
            $markup = $translator->translate($markup);
        }
        return $markup;
    }
}

// Iterate though directories
$doc = fopen("index.html", "w");
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("."));
while($it->valid()) {
    if (!$it->isDot() && preg_match("/\.wiki$/", $it->getSubPathName())) {
        fwrite($doc, Client::convert(
        file_get_contents($it->getSubPathName())));
    }
    $it->next();
}
fclose($doc);
