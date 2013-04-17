<?php
/**
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Translator;

class Block extends AbstractTranslator
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