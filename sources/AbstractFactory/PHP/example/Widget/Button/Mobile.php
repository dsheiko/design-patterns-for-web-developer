<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Widget\Button;

// Concrete Product
class Mobile implements \Widget\Button\iButton
{
    public function render()
    {
        print "jQueryMobile based button";
    }
}