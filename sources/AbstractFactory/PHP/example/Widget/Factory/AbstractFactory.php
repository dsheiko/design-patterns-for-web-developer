<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Widget\Factory;

// Abstract Factory
abstract class AbstractFactory
{
    abstract public function makeDialog();
    abstract public function makeButton();
}