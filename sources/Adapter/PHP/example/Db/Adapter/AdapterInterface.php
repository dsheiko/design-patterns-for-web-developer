<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */
namespace Db\Adapter;
/**
 * Abstract interface
 */
interface AdapterInterface
{
    public function connect(\Db\Config $config);
    public function fetch($sql);
}