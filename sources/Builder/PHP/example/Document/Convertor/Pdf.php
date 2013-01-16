<?php

// Concrete builder
// File: ./Document/Convertor/Pdf.php
namespace Document\Convertor;

class Pdf extends \Document\AbstractConvertor
{
    public function setAuthor($author)
    {
        $this->_buffer .= "PDF: Author info {$author}\n";
    }
    public function setTitle($title)
    {
        $this->_buffer .= "PDF: Title info {$title}\n";
    }
    public function setText($text)
    {
        $this->_buffer .= "PDF: {$text}\n";
    }
    
}