<?php
/**
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Translator;

class PerLine extends AbstractTranslator
{
    private $_convertor;
    public function __construct($convertor)
    {
        $this->_convertor = $convertor;
    }
    public function translate($markup)
    {
        $indices = array();
        $lines = explode("\n", $markup);
        if (!$lines) {
            return $markup;
        }
        foreach ($lines as $inx => $line) {
            // Parse h{n}. header
            if (preg_match("/^\s*h(\d)\.(.*?)$/", $line, $matches)) {
                $lines[$inx] = $this->_convertor->convertHeader($matches[1], $matches[2]);
            }
            // Parse * list item
            if (preg_match("/^\s*\*/", $lines[$inx])) {
                $lines[$inx] = $this->_convertor->convertLi(
                    preg_replace("/^\s*\*/", "", $lines[$inx])
                );
                if (!isset($indices[$inx - 1])) {
                    $lines[$inx] = $this->_convertor->getUlOpening() . $lines[$inx];
                }
                $indices[$inx] = true;
            } else {
                if (isset($indices[$inx - 1])) {
                    $lines[$inx] = $lines[$inx] . $this->_convertor->getUlClosing();
                }
            }
        }
        if (isset($indices[$inx])) {
            $lines[$inx] = $this->_convertor->getUlClosing() . $lines[$inx];
        }
        return implode("\n", $lines);
    }
}