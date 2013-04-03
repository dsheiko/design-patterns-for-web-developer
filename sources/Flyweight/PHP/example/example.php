<?php
/*
 * @category Design Pattern Tutorial
 * @package Flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

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
