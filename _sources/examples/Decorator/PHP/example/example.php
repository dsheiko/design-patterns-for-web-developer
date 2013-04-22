<?php
/*
 * @category Design Pattern Tutorial
 * @package Decorator Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

/*
 * Usage 
 */
include "./Widget/WidgetInterface.php";
include "./Widget/Concrete.php";
include "./Widget/Decorator/AbstractDecorator.php";
include "./Widget/Decorator/ScrollBar.php";
include "./Widget/Decorator/StatusBar.php";

$widget = new \Widget\Decorator\StatusBar(
    new \Widget\Decorator\ScrollBar(
        new \Widget\Concrete()
    )
);
print $widget->render() . PHP_EOL;

/*
 * Output
 */
// Concrete widget with scrollbar with statusbar