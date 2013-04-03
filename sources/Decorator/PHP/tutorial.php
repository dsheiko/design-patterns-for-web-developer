<?php
/*
 * @category Design Pattern Tutorial
 * @package Decorator Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


// File: ./Widget/Concrete.php
namespace Widget;

// Default implementation of a Widget
final class Concrete implements WidgetInterface
{
    public function render() 
    {
        return "Concrete widget";
    }
}

// File: ./Widget/Decorator/AbstractDecorator.php
namespace Widget\Decorator;

// Abstract decorator class that implements WidgetInterface
abstract class AbstractDecorator implements \Widget\WidgetInterface
{
    protected $_widget;
    public function __construct(\Widget\WidgetInterface $widget) 
    {
        $this->_widget = $widget;
    }
    public function render()
    {        
        return $this->_widget->render();
    }
}

// File: ./Widget/Decorator/ScrollBar.php
namespace Widget\Decorator;

// Concrete decorator which adds scrollbar functionality
class ScrollBar extends AbstractDecorator
{
    public function __construct(\Widget\WidgetInterface $widget) 
    {
        parent::__construct($widget);
    }
    public function render() 
    {
        return parent::render() . " with scrollbar";
    }
}

// File: ./Widget/Decorator/StatusBar.php
namespace Widget\Decorator;

// Concrete decorator which adds statusbar functionality
class StatusBar extends AbstractDecorator
{
    public function __construct(\Widget\WidgetInterface $widget) 
    {
        parent::__construct($widget);
    }
    public function render() 
    {
        return parent::render() . " with statusbar";
    }
}

// File: ./Widget/WidgetInterface.php
namespace Widget;
// Widget interface
interface WidgetInterface
{
    public function render();
}
//File: example.php

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