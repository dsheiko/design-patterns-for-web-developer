<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

namespace Glyph;

/*
 * Unshared concerte flyweight
 */
class Row extends AbstractGlyph
{
    // Has concrete flyweight objects as children
    protected $_glyphs = array();
    
    // Render row of characters on the window
    public function render(\Window\Context $window, \Glyph\Context &$glyphContext)
    {
        $glyphContext->setSeqContext($this);
        $glyphContext->rewind();
        foreach ($this->_glyphs as $glyph) {
            $glyph->render($window, $glyphContext);
            $glyphContext->next();
        }
    }
   
    // Insert a character into the row
    public function insert(\Glyph\AbstractGlyph $glyph, \Glyph\Context &$glyphContext)
    {
        $this->_glyphs[] = $glyph;
        $glyphContext->setSeqContext($this);
        $glyphContext->next();
        return $this;
    }
    
    // Switch font on the context
    public function setFont(\Font\AbstractFont $font, \Glyph\Context &$glyphContext)
    {
        $glyphContext->setSeqContext($this);
        $glyphContext->setFont($font);
        return $this;
    }
}