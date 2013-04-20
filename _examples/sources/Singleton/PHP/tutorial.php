<?php
/*
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

class Singleton
{
    private static $_instance = null;

    public $foo = "value";

    public static function getInstance()
    {
        if (self::$_instance) {
            return self::$_instance;
        }
        return (self::$_instance = new self());
    }

}
/**
 * Usage
 */
var_dump(\Singleton::getInstance() === \Singleton::getInstance());

/**
 * Output
 */
// true