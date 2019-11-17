<?php

namespace Migrations;

use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;

abstract class AbstractVersion
{
    /**
     * @var string
     */
    public $description = '';

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Adapter
     */
    protected $dbAdapter;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->dbAdapter = $container->get(Adapter::class);
    }

    abstract public function up();

    /**
     * @param $sql
     * @return \Zend\Db\Adapter\Driver\StatementInterface|\Zend\Db\ResultSet\ResultSet
     */
    protected function executeQuery($sql)
    {
        return $this->dbAdapter->query($sql, Adapter::QUERY_MODE_EXECUTE);
    }
}
