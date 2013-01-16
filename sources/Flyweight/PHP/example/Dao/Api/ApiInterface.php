<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Dao\Api;
/**
 * Implementor
 */
interface ApiInterface
{
    public function fetchProfile($guid);
}