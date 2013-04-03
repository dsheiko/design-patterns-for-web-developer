<?php
/*
 * @category Design Pattern Tutorial
 * @package Builder Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Document;

abstract class AbstractConvertor
{
    protected $_buffer;
    abstract public function setAuthor($author);
    abstract public function setTitle($title);
    abstract public function setText($text);
    public function getDocument()
    {
        return$this->_buffer;
    }
}
