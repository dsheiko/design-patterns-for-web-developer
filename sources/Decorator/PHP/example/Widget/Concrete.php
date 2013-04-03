<?php
/*
 * @category Design Pattern Tutorial
 * @package Decorator Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Widget;

// Default implementation of a Widget
final class Concrete implements WidgetInterface
{
    public function render() 
    {
        return "Concrete widget";
    }
}