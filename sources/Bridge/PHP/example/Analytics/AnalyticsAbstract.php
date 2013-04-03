<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

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