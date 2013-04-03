<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

namespace Glyph;

/*
 * Flyweight interface
 */
abstract class AbstractGlyph
{
    abstract public function render(\Window\Context $window, 
        \Glyph\Context &$glyphContext);
}