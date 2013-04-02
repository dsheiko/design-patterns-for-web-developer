<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

namespace Db;
/**
 * Usage
 */
class Config
{
    public $driver = 'Mysqli';
    public $host = 'localhost';
    public $user = 'test';
    public $password = 'test';
    public $dbscheme = 'test_test';
}