<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

namespace Glyph;

/*
 * Repository of extrinsic state. 
 * Here it keeps flyweight (character) attributes such as font info
 * By applying various contextes we can make the same glyph 
 * structure look differently
 */

class Context 
{
    private $_fonts = array();
    private $_indices = array();
    private $_curFont = array();
    private $_defaultFont;
    
    public function __construct() 
    {
        $this->_defaultFont = new \Font\Times();
    }
    // To the begining of the sequence
    public function rewind()
    {
        $this->_indices[$this->seqId] = 0;
    }
    // Iterate sequence index
    public function next()
    {
        $this->_indices[$this->seqId]++;
    }
    // Mark the point where font switches on the sequence
    public function setFont(\Font\AbstractFont $font)
    {
        $this->_fonts[$this->_indices[$this->seqId]] = $font;
    }
    public function getFont()
    {
        if (isset ($this->_fonts[$this->_indices[$this->seqId]])) {
            $this->_curFont[$this->seqId] = $this->_fonts[$this->_indices[$this->seqId]];
        } 
        return isset($this->_curFont[$this->seqId]) ? 
            $this->_curFont[$this->seqId] : 
            $this->_defaultFont;
        
    }
    public function setSeqContext(\Glyph\AbstractGlyph $visitor)
    {
        $this->seqId = spl_object_hash($visitor);
    }
}
