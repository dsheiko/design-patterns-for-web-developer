<?php
include './Document/Entity.php';
include './Document/Reader.php';
include './Document/AbstractConvertor.php';
include './Document/Convertor/Pdf.php';
include './Document/Convertor/Epub.php';



// File: ./Document/AbstractConvertor.php
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


// File: ./Document/Convertor/Epub.php
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

// File: ./Document/Entity.php
    public $author = "George R. R. Martin";
    public $title = "The Song of Ice and Fire";
    public $chapters = array("Chapter 1", "Chapter 2");
}


// File: ./Document/Reader.php
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
//File: example.php
// Usage example

$doc = new \Document\Entity();
$convertor = new \Document\Convertor\Pdf();
$reader = new \Document\Reader();
print $reader->getDocument($doc, $convertor);
