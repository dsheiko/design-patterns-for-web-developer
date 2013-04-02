<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

include 'Analytics/Imp/ImpAbstract.php';
include 'Analytics/Imp/GoogleAnalytics.php';
include 'Analytics/Imp/LocalAnalytics.php';
include 'Analytics/AnalyticsAbstract.php';
include 'Analytics/GraphViewData.php';
include 'Analytics/TableViewData.php';


/**
 * Usage
 */
$tblDataSrc = new \Analytics\TableViewData();
var_dump($tblDataSrc->queryVisitsRate());

$graphDataSrc = new \Analytics\GraphViewData();
var_dump($graphDataSrc->queryAudienceStats());
/*
 * Output
 */
// Visits rate stats array
// ["Visits rate stats array","Page views rate stats array"]