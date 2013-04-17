<?php
/**
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Translator;

class Paragraph extends AbstractTranslator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    public function translate($markup)
    {
        // CR+LF to LF
        $markup = preg_replace("/\r/s", "", $markup);
        // Remove trailing spaces
        $markup = preg_replace("/\n\s+\n/s", "\n\n", $markup);
        // Remove repeating EOL
        $markup = preg_replace("/\n{2}/s", "\n\n", $markup);
        $pars = explode("\n\n", $markup);
        $convertor = $this->_convertor;

        return array_reduce($pars, function($acc, $p) use($convertor) {
            $p = trim($p);
            $acc .= (strpos($p, "<") === 0 || strpos($p, "[") === 0) ?
                $p . PHP_EOL :
                $convertor->convertParagraph($p) ;
            return $acc;
        }, "");
    }
}