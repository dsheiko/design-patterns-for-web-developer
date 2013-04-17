<?php
/**
 * Docs Build Script
 *
 * I want my documentaiton sources be readable, easy to maintain and ready
 * for different representation. XML would serve a source for later convertion,
 * but it's not easy to maintain. Here come on mind custom markup languages such
 * as Wiki, Confluence, Markdown. It's almost what I want, but rather with
 * some extension (e.g. semantical elements like <var>, <dfn> are
 * essential for my docs and therefore I need extra syntax. Besides, I want it
 * to be consitent. So, I use a custom markup (kind of compilation of
 * Confluence and Markdown) and here is the convertor exploiting Translator
 * pattern to generate from my documentation sources HTML.
 *
 * Double-EOL indicates a new paragraph
 * Lists are being extracted from line gropus preceding by *
 * Special tags:
 * [link:url|title]
 * [img:url|title]
 * [code:path]
 * [var:title]
 * [dfn:title]
 * [samp:title]
 * [blockquote:content|author|title|url]
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
define("PATH_BUILD", __DIR__);
define("PATH_ROOT", realpath(PATH_BUILD . "/.."));

include PATH_BUILD . "/Lib/Convertor/AbstractConvertor.php";
include PATH_BUILD . "/Lib/Convertor/Html.php";
include PATH_BUILD . "/Lib/Translator/AbstractTranslator.php";
include PATH_BUILD . "/Lib/Translator/Block.php";
include PATH_BUILD . "/Lib/Translator/PerLine.php";
include PATH_BUILD . "/Lib/Translator/Paragraph.php";

class Client
{
    static public function convert($markup)
    {
        $convertor = new \Convertor\Html();
        $translators = array(
            "\Translator\PerLine",
            "\Translator\Paragraph",
            "\Translator\Block",
        );
        foreach ($translators as $className) {
            $translator = new $className($convertor);
            $markup = $translator->translate($markup);
        }
        return $markup;
    }
}

// Iterate though directories
$doc = fopen("index.html", "w");
$it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator("."));
while($it->valid()) {
    if (!$it->isDot() && preg_match("/\.wiki$/", $it->getSubPathName())) {
        fwrite($doc, Client::convert(
        file_get_contents($it->getSubPathName())));
    }
    $it->next();
}
fclose($doc);
