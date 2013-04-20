<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

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