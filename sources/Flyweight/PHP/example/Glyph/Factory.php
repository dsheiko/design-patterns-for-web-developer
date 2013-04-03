<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

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