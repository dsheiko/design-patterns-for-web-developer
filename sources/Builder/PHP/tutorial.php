<?php
/*
 * @category Design Pattern Tutorial
 * @package Builder Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


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

// File: ./Document/Convertor/Epub.php
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


// File: ./Document/Entity.php
namespace Document;

class Entity
{
    public $author = "George R. R. Martin";
    public $title = "The Song of Ice and Fire";
    public $chapters = array("Chapter 1", "Chapter 2");
}

//File: example.php
include './Document/Entity.php';
include './Document/Reader.php';
include './Document/AbstractConvertor.php';
include './Document/Convertor/Pdf.php';
include './Document/Convertor/Epub.php';

// Usage example

$doc = new \Document\Entity();
$convertor = new \Document\Convertor\Pdf();
$reader = new \Document\Reader();
print $reader->getDocument($doc, $convertor);
