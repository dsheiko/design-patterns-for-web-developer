<?php
/**
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Convertor;

class Html extends AbstractConvertor
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