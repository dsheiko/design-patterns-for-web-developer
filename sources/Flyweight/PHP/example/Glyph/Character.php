<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

namespace Glyph;

/*
 * Concerte flyweight, keeps intrinsic state
 */
class Character extends AbstractGlyph
{
    // Intirinsic state, independent of GlyphContext
    private $_char;
    
    public function __construct($char) 
    {
        $this->_char = $char;
    }
    
    // Render character on the window
    public function render(\Window\Context $window, \Glyph\Context &$glyphContext)
    {
        $window->push($this->_char, $glyphContext->getFont()->attr, spl_object_hash($this));
    }
}