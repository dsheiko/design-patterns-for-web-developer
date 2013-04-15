<?php
/**
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Convertor;

abstract class AbstractConvertor
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