<?php
/*
 * @category Design Pattern Tutorial
 * @package Composite Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @link http://dsheiko.com
 */


// Abstract component
abstract class Element
{
    // Child-element collection
    protected $_collection = array();
    // Element name
    protected $_name;
    // Element text 
    protected $_text;
    // Indent multiplier 
    static $_iCount = 0;
    
    public function __construct($text = "") 
    {
        $this->_text = $text;
        
    }

    public function add(Element $el)
    {
        $this->_collection[] = $el;
    }
    // Mock render
    public function render() 
    {
        $indent = str_repeat("  ", self::$_iCount);
        print $indent . "Element {$this->_name}" . 
            ($this->_text ? " ({$this->_text})": "") . "\n";
        $this->_renderEach();
        
    }
    // Render each of child-elements
    protected function _renderEach()
    {
        if (!$this->_collection) {
            return;
        }
        self::$_iCount++;
        foreach ($this->_collection as $el) {
            $el->render();
        }
    }
}
// Div composition
class Div extends Element
{
    protected $_name = "Div";
    
}
// P composition
class P extends Element
{
    protected $_name = "P";
   
}
// Leaf object of the composition
class Span extends Element
{
    protected $_name = "Span";
    
}

/**
 * Usage
 */
$span1 = new Span("text 1");
$span2 = new Span("text 2");
$p = new P();
$p->add($span1);
$p->add($span2);
$div = new Div();
$div->add($p);
$div->render();

// Output:
// Element Div
//   Element P
//     Element Span (text 1)
//     Element Span (text 2)