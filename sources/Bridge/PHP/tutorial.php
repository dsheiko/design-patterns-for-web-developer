<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


// File: ./Analytics/TableViewData.php
namespace Analytics;
// Refined Abstraction
class TableViewData extends AnalyticsAbstract
{
}

// File: ./Analytics/GraphViewData.php
namespace Analytics;
// Refined Abstraction
class GraphViewData extends AnalyticsAbstract
{
    public function queryAudienceStats($profileId = 0, $sDate = "", $eDate = "")
    {
        return json_encode(array(
            $this->_imp->queryVisitsRate($profileId, $sDate, $eDate),
            $this->_imp->queryPageViewsRate($profileId, $sDate, $eDate)
        ));
    }
}

// File: ./Analytics/Imp/GoogleAnalytics.php

namespace Analytics\Imp;
// Concrete implementror
class GoogleAnalytics extends ImpAbstract
{
    public function queryVisitsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day')
    {
        // Mock query
        return "Visits rate stats array";
    }
    public function queryPageViewsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day')
    {
        // Mock query
        return "Page views rate stats array";
    }
}

// File: ./Analytics/Imp/LocalAnalytics.php
namespace Analytics\Imp;

// Concrete implementror
class LocalAnalytics extends ImpAbstract
{
    public function queryVisitsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day')
    {
        // Mock query
        return "Visits rate stats array";
    }
    public function queryPageViewsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day')
    {
        // Mock query
        return "Page views rate stats array";
    }
}

// File: ./Analytics/Imp/ImpAbstract.php

namespace Analytics\Imp;
// Implementer on the Bridge
abstract class ImpAbstract
{
    abstract public function queryVisitsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day');
    abstract public function queryPageViewsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day');
}

// File: ./Analytics/AnalyticsAbstract.php

namespace Analytics;
// Abstraction on the Bridge
// Abstraction forwards client requests to its Implementor object.
class AnalyticsAbstract
{
    protected $_imp;
    public function __construct()
    {
        $this->_imp = new \Analytics\Imp\GoogleAnalytics();
    }
    public function queryVisitsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day')
    {
        return $this->_imp->queryVisitsRate($profileId, $sDate, $eDate);
    }
    public function queryPageViewsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day')
    {
        return $this->_imp->queryPageViewsRate($profileId, $sDate, $eDate);
    }
}
//File: example.php

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