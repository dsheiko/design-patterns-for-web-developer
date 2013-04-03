<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

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