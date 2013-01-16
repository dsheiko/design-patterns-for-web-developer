<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

namespace Dao\Api;
/**
 * Concrete implementor 1
 */
class Remote implements ApiInterface
{
    public function fetchProfile($guid)
    {
        return sprintf ("Profile #%d via remote API\n", $guid);
    }
}