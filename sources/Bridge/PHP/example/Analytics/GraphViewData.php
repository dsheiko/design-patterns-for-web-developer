<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
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