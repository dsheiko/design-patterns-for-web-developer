<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Widget\Factory;

// Concrete Factory
class Desktop extends AbstractFactory
{
    public function makeDialog()
    {
        return new \Widget\Dialog\Desktop();
    }
    public function makeButton()
    {
        return new \Widget\Button\Desktop();
    }
}