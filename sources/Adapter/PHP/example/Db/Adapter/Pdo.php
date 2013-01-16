<?php
/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT 
 */

namespace Db\Adapter;
/**
 * MySQLi Pdo
 */
class Pdo implements \Db\Adapter\AdapterInterface
{
    private $_dbh;

    public function connect(\Db\Config $config)
    {
        $dsn = sprintf('msqli::dbname=%s;host=%s', $config->dbscheme, $config->host);
        $this->_dbh = new \PDO($dsn, $config->user, $config->password);
    }
    public function fetch($sql)
    {
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();
        return $sth->fetch();
    }
}