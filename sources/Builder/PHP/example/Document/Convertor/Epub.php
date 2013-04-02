<?php
/*
 * @category Design Pattern Tutorial
 * @package Builder Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Document\Convertor;

class Epub extends \Document\AbstractConvertor
{
    public function setAuthor($author)
    {
        $this->_buffer .= "ePub: Author info {$author}\n";
    }
    public function setTitle($title)
    {
        $this->_buffer .= "ePub: Title info {$title}\n";
    }
    public function setText($text)
    {
        $this->_buffer .= "ePub: {$text}\n";
    }
}