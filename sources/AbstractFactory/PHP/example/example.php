<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

/**
 * Usage
 */
include "./Widget/Factory/AbstractFactory.php";
include "./Widget/Factory/Desktop.php";
include "./Widget/Factory/Mobile.php";
include "./Widget/Dialog/iDialog.php";
include "./Widget/Dialog/Desktop.php";
include "./Widget/Dialog/Mobile.php";
include "./Widget/Button/iButton.php";
include "./Widget/Button/Desktop.php";
include "./Widget/Button/Mobile.php";
include "./Config.php";
include "./Application.php";

$config = new Config();
$config->platform = "mobile";
$app = new Application($config);
$app->build();

/*
 * Output
 */
// jQueryMobile based dialog
// jQueryMobile based button