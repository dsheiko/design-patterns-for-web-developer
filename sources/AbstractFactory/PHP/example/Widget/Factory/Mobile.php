<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Widget\Factory;

// Concrete Factory
class Mobile extends AbstractFactory
{
    public function makeDialog()
    {
        return new \Widget\Dialog\Mobile();
    }
    public function makeButton()
    {
        return new \Widget\Button\Mobile();
    }
}