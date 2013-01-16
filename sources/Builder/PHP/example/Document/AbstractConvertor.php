<?php

// Abstract builder
// File: ./Document/AbstractConvertor.php
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
