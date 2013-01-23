<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


// File: ./Font/AbstractFont.php

namespace Font;

/*
 * Sample fonts
 */
abstract class AbstractFont
{

}

// File: ./Font/Times.php

namespace Font;

class Times extends AbstractFont
{
    public $attr = "Times Roman 12 ";
}

// File: ./Font/VerdanaBold.php

namespace Font;

class VerdanaBold extends AbstractFont
{
    public $attr = "Verdana Bold 12";
}

// File: ./Glyph/AbstractGlyph.php

namespace Glyph;

/*
 * Flyweight interface
 */
abstract class AbstractGlyph
{
    abstract public function render(\Window\Context $window, 
        \Glyph\Context &$glyphContext);
}

// File: ./Glyph/Character.php

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

// File: ./Glyph/Context.php

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


// File: ./Glyph/Factory.php

namespace Glyph;

/*
 * Creates flyweights and ensures they are shared properly
 */
class Factory
{
    // The _chars array contains pointers to Character glyphs indexed 
    // by character.
    private static $_chars = array();
   
    public static function createChar($char)
    {
        if (!isset(self::$_chars[$char])) {
            self::$_chars[$char] = new \Glyph\Character($char);
        }
        return self::$_chars[$char];
    }
    public static function createRow()
    {
        return new \Glyph\Row();
    }
}

// File: ./Glyph/Row.php

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

// File: ./Window/Context.php

namespace Window;

/*
 * Output context
 */
class Context 
{
    private $_chars = array();
    private $_attrs = array();
    private $_hashes = array();
    
    public function push($char, $attr, $objHash)
    {
        $this->_chars[] = $char;
        $this->_attrs[] = $attr;
        $this->_hashes[] = $objHash;
    }
    public function render()
    {
        $matches = array_count_values($this->_hashes);
        print "Row content:\n";
        foreach ($this->_chars as $inx => $char) {
            printf("%s - %s%s\n", $char, $this->_attrs[$inx], 
                $matches[$this->_hashes[$inx]] > 1 ? "  reused" : ""); 
        }
    }
}
//File: example.php

include 'Glyph/AbstractGlyph.php';
include 'Glyph/Character.php';
include 'Glyph/Context.php';
include 'Glyph/Factory.php';
include 'Glyph/Row.php';
include 'Font/Abstractfont.php';
include 'Font/Times.php';
include 'Font/VerdanaBold.php';
include 'Window/Context.php';



// Shortcut function
function char($char)
{
    return \Glyph\Factory::createChar($char);
}

/**
 * Usage
 */

$window = new \Window\Context();
$times = new \Font\Times();
$verdana = new \Font\VerdanaBold();
$row = \Glyph\Factory::createRow();
$context = new \Glyph\Context();
$row->insert(char("e"), $context)
       ->insert(char("x"), $context)
       ->insert(char("c"), $context)
       ->setFont($verdana, $context) 
       ->insert(char("e"), $context)
       ->insert(char("e"), $context)
       ->setFont($times, $context)
       ->insert(char("d"), $context)
       ->render($window, $context);

$window->render();

/*
 * Output
 */
//Row content:
//e - Times Roman  12  reused
//x - Times Roman  12
//c - Times Roman  12
//e - Verdana Bold 12  reused
//e - Verdana Bold 12  reused
//d - Times Roman  12
