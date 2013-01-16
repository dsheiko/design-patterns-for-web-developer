<?php
/*
 * @category Design Pattern Tutorial
 * @package Decorator Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
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