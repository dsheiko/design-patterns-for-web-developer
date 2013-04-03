<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */


// File: ./Db/Adapter/AdapterInterface.php
namespace Db\Adapter;
/**
 * Abstract interface
 */
interface AdapterInterface
{
    public function connect(\Db\Config $config);
    public function fetch($sql);
}

// File: ./Db/Adapter/Mysql.php
namespace Db\Adapter;
/**
 * MySQLi Adapter
 */
class Mysqli implements \Db\Adapter\AdapterInterface
{
    private $_mysqli;

    public function connect(\Db\Config $config)
    {
        $this->_mysqli = new \mysqli($config->host, $config->user, $config->password
            , $config->dbscheme);
    }
    
    public function fetch($sql)
    {
        return $this->_mysqli->query($sql)->fetch_object();
    }
    
}

// File: ./Db/Adapter/Pdo.php

namespace Db\Adapter;
/**
 * MySQLi Pdo
 */
class Pdo implements \Db\Adapter\AdapterInterface
{
    private $_dbh;

    public function connect(\Db\Config $config)
    {
        $dsn = sprintf('msqli::dbname=%s;host=%s', $config->dbscheme, $config->host);
        $this->_dbh = new \PDO($dsn, $config->user, $config->password);
    }
    public function fetch($sql)
    {
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();
        return $sth->fetch();
    }
}

// File: ./Db/Config.php

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

// File: ./Db/Factory.php

namespace Db;
/**
 * Db Factory
 */
class Factory
{
    public static function connect(Config $config)
    {
        $className = sprintf("\\Db\\Adapter\\%s", $config->driver);
        if (class_exists($className)) {
            $adapter = new $className();
            $adapter->connect($config);
            return $adapter;
        }
    }
}
//File: example.php
include "Db/Config.php";
include "Db/Factory.php";
include "Db/Adapter/AdapterInterface.php";
include "Db/Adapter/Mysql.php";
include "Db/Adapter/Pdo.php";

$config = new \Db\Config();

$db = \Db\Factory::connect($config);
var_dump($db->fetch('SELECT * FROM `test`'));