<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */
include "Db/Config.php";
include "Db/Factory.php";
include "Db/Adapter/AdapterInterface.php";
include "Db/Adapter/Mysql.php";
include "Db/Adapter/Pdo.php";

$config = new \Db\Config();

$db = \Db\Factory::connect($config);
var_dump($db->fetch('SELECT * FROM `test`'));