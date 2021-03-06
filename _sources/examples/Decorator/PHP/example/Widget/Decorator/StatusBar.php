<?php
/*
 * @category Design Pattern Tutorial
 * @package Decorator Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
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