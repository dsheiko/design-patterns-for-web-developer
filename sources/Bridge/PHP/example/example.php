<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

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