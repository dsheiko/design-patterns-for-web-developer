<?php
// Director
// File: ./Document/Reader.php
namespace Document;

class Reader
{
    public function getDocument(\Document\Entity $document
        , \Document\AbstractConvertor $convertor)
    {
        $convertor->setAuthor($document->author);
        $convertor->setTitle($document->title);
        foreach ($document->chapters as $chapter) {
            $convertor->setText($chapter);
        }
        return $convertor->getDocument();
    }
    
}