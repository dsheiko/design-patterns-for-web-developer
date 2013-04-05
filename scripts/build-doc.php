<?php




class HtmlConvertor
{
    public function convertLink($url, $content)
    {
        return strtr('<a href="[url]">[content]</a>', array(
            "[url]" => $url,
            "[content]" => $content
        ));
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
        return $content ? "<p>{$content}</p>" : "";
    }
    public function convertLi($content)
    {
        return $content ? "<li>{$content}</li>" : "";
    }
    public function getUlOpening()
    {
        return "<ul>\n";
    }
    public function getUlClosing()
    {
        return "\n</ul>";
    }
}

// translate macros
// translate inline
// trnslate lists
class BlockTranslator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    /**
     * [link:url|title]
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
class PerLineTranslator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    /**
     * * list item
     * 
     */
    public function translate($markup)
    {
        $indices = array();
        $lines = explode("\n", $markup);
        if (!$lines) {
            return $markup;
        }
        var_dump($lines);
        foreach ($lines as $inx => $line) {
            if (preg_match("/^\s*\*/", $line)) {
                if (!isset($indices[$inx - 1])) {
                    $line = $this->_convertor->getUlOpening() . $line;
                }
                $indices[$inx] = true;
                $line = $this->_convertor->convertLi($line);
            } else {
                if (isset($indices[$inx - 1])) {
                    $line = "\n</ul>" . $line;
                }
            }
        }
        if (isset($indices[$inx])) {
            $lines[$inx] = $lines[$inx] . $this->_convertor->getUlClosing();
        }
        return implode("\n", $lines);
    }
}
class ParagraphTranslator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    public function translate($markup)
    {
        $markup = preg_replace("/\r/s", "", $markup);
        // Remove trailing spaces
        $markup = preg_replace("/\n\s+\n/s", "\n\n", $markup);
        $markup = preg_replace("/\n{2}/s", "\n\n", $markup);
        $pars = explode("\n\n", $markup);
        $convertor = $this->_convertor;
        return array_reduce($pars, function($acc, $p) use($convertor) {
            $acc .= $convertor->convertParagraph($p);
            return $acc;
        }, "");
    }
}
class Client
{
    static public function convert($markup)
    {
        $convertor = new HtmlConvertor();
        $translator = new BlockTranslator($convertor);
        $markup = $translator->translate($markup);
         $translator = new PerLineTranslator($convertor);
        $markup = $translator->translate($markup);
        $translator = new ParagraphTranslator($convertor);
        $markup = $translator->translate($markup);
       
        return $markup;
    }
}

// *xxx* - bold
// _xxx_ - italic
// -xxx- - strike
// +xxx+ - underline
// ^xxx^ - superscript
// h1. xxx - header
// [title|link] or [link] - external link
//      [title|abbr:text] - abbreviated phrase (http://reference.sitepoint.com/html/abbr)
//      [title|acronym:text] - acronym (http://reference.sitepoint.com/html/acronym)
//      [dfn:text] - defining instance of a term (http://reference.sitepoint.com/html/dfn)
//      [samp:text] - a sample of characters (http://reference.sitepoint.com/html/samp)
//      [var:text] - variable (http://reference.sitepoint.com/html/var)
//      [blockquote:quote|author|title|url]
//
//
// !filename|title=title! - atttached image
//  * xxx - list
//  *# xxx - list
// ||col1||col2|| - table
// |cell1|cell2|
// {code:php}xxx{code} - code
// {html}xxx{html} - html
// {quote}xxx{quote} - quoting


var_dump( Client::convert('
    xxxx [var:xxxxx] xxc
    xxxx
    xxx
    
* item1
* item2
* item3

    xxxxxx
    xxxx
    xxx

    ccvvv
'));