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

namespace Bridge\Imp;
class AnalyticsAbstract
{
    public function queryVisitsOverTime($profileId = 0, $sDate = "", $eDate = "")
    {
        
    }
    public function queryPageViewsOverTime($profileId = 0, $sDate = "", $eDate = "")
    {
        
    }
}
class GoogleAnalytics
{
    private function _queryVisitsPageViews($profileId = 0, $sDate = "", $eDate = "")
    {
        static $queryCache = array();
        $cacheKey = md5(implode("+", func_get_args()));
        if (isset ($queryCache[$cacheKey])) {
            return $queryCache[$cacheKey];
        }
        $queryCache[$cacheKey] = $this->_queryTable($profileId,
            date("Y-m-d", strtotime($sDate)),
            date("Y-m-d", strtotime($eDate)), 
            'ga:visits, ga:pageviews',
            array(
                'dimensions' => 'ga:date',
                'sort' => 'ga:date'
            ));
    }
    public function queryVisitsOverTime($profileId = 0, $sDate = "", $eDate = "")
    {
        $fetch = $this->_queryVisitsPageViews($profileId, $sDate, $eDate);
        return array_map (function (&$item)
        {
            return array ("dt" => $item[0], "visits" => $item[1]);
        }, $fetch);
    }
    public function queryPageViewsOverTime($profileId = 0, $sDate = "", $eDate = "")
    {
        $fetch = $this->_queryVisitsPageViews($profileId, $sDate, $eDate);
        return array_map (function (&$item)
        {
            return array ("dt" => $item[0], "pageViews" => $item[2]);
        }, $fetch);
    }
}

namespace Bridge;
class AnalyticsAbstract
{
    
}



/**
     * Get page views/visitors per day table
     *
     * @param string $sDate
     * @param string $eDate
     * @param int $profileId
     * @return array [[datatime, visits, page views], ...]
     */
      public function queryVisitsPageViews($sDate = "", $eDate = "", $profileId = 0)
      {
          return array_map(function( $val )
          {
              $val[0] = strtotime( $val[0] . " UTC") * 1000;
              return $val;
          }, $this->_queryTable($profileId,
                 date("Y-m-d", strtotime( $sDate ? $sDate : '-1 week' )),
                 date("Y-m-d", strtotime( $eDate ? $eDate : '-1 day' )),
                'ga:visits, ga:pageviews',
                array(
                    'dimensions' => 'ga:date',
                    'sort' => 'ga:date'
                )
            ));
      }






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