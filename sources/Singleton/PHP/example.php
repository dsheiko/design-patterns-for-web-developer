<?php
/*
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Lib;

class Registry
{
    private static $_instance = null;
    private $_data = array();

    public static function getInstance()
    {
        if (self::$_instance) {
            return self::$_instance;
        }
        return (self::$_instance = new self());
    }

    public function  __set($name,  $value)
    {
        $this->_data[$name] = $value;
    }
    public function  __get($name)
    {
        return (isset ($this->_data[$name]) ? $this->_data[$name] : null);
    }

}
/**
 * Usage
 */
\Lib\Registry::getInstance()->aVar = 'aValue';
var_dump(\Lib\Registry::getInstance()->aVar);