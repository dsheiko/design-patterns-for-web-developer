<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @link http://dsheiko.com
 */


// File: ./Dao/Api/ApiInterface.php

namespace Dao\Api;
/**
 * Implementor
 */
interface ApiInterface
{
    public function fetchProfile($guid);
}

// File: ./Dao/Api/Local.php

namespace Dao\Api;
/**
 * Concrete implementor 2
 */
class Local implements ApiInterface
{
    public function fetchProfile($guid)
    {
        return sprintf ("Profile #%d via local API\n", $guid);
    }
}

// File: ./Dao/Api/Remote.php

namespace Dao\Api;
/**
 * Concrete implementor 1
 */
class Remote implements ApiInterface
{
    public function fetchProfile($guid)
    {
        return sprintf ("Profile #%d via remote API\n", $guid);
    }
}

// File: ./Dao/User.php

namespace Dao;
/**
 * Abstraction
 */
class User
{
    private $_api;
    public function  __construct($apiName)
    {
        switch ($apiName) {
            case "local":
                $this->_api = new \Dao\Api\Local();
                break;
            case "remote":
                $this->_api = new \Dao\Api\Remote();
                break;
            default:
                throw new \Exception("Invalid API " . $apiName);
        }
    }
    public function fetchProfile($guid)
    {
        return $this->_api->fetchProfile($guid);
    }
}
//File: example.php

include 'Dao/Api/ApiInterface.php';
include 'Dao/Api/Local.php';
include 'Dao/Api/Remote.php';
include 'Dao/User.php';

/**
 * Usage
 */
$dao = new \Dao\User("remote");
print $dao->fetchProfile(1);

$dao = new \Dao\User("local");
print $dao->fetchProfile(1);

/*
 * Output
 */
// Profile #1 via remote API
// Profile #1 via local API