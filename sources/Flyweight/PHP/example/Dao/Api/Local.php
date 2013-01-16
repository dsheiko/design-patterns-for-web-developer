<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Dao\Api;
/**
 * Concrete implementor 2
 */
class Local implements ApiInterface
{
    public function fetchProfile($guid)
    {
        return sprintf ("Profile #%d via local API\n", $guid);
    }
}