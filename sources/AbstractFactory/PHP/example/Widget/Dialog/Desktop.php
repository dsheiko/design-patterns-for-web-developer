<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Widget\Dialog;

// Concrete Product
class Desktop implements \Widget\Dialog\iDialog
{
    public function render()
    {
        print "jQueryUI based dialog";
    }
}