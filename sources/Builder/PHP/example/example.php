<?php
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
