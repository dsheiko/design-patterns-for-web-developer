<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

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