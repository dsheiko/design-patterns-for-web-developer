<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Analytics\Imp;
// Implementer on the Bridge
abstract class ImpAbstract
{
    abstract public function queryVisitsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day');
    abstract public function queryPageViewsRate($profileId = 0, $sDate = '-1 week', $eDate = '-1 day');
}