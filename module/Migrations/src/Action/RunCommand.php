<?php

namespace Migrations\Action;

use RuntimeException;
use Psr\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

class RunCommand
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var TableGateway
     */
    private $migrationsTable;

    public function __construct(
        ContainerInterface $container,
        TableGateway $migrationsTable
    ) {
        $this->container = $container;
        $this->migrationsTable = $migrationsTable;
    }

    /**
     * @param RunCommandContext $context
     * @throws \Exception
     */
    public function handle(RunCommandContext $context)
    {
        $versionClass = 'Data\Migrations\Version_' . $context->getVersionNum();

        if (!class_exists($versionClass)) {
            throw new RuntimeException("Version $versionClass not exists");
        }

        $version = new $versionClass($this->container);

        if (!$version instanceof \Migrations\AbstractVersion) {
            throw new RuntimeException("Version $versionClass not instance of " . \Migrations\AbstractVersion::class);
        }

        if ($this->isRegistered($context->getVersionNum())) {
            throw new RuntimeException("Version " . $context->getVersionNum() . " already applied");
        }

        try {
            $this->migrationsTable->getAdapter()->getDriver()->getConnection()->beginTransaction();
            $version->up();
            $this->migrationsTable->getAdapter()->getDriver()->getConnection()->commit();
        } catch (\Exception $ex) {
            $this->migrationsTable->getAdapter()->getDriver()->getConnection()->rollback();
            throw $ex;
        }

        $this->register($context->getVersionNum());
    }

    private function register($versionNum)
    {
        $this->migrationsTable->insert(['version' => $versionNum]);
    }

    private function isRegistered($versionNum)
    {
        /** @var ResultSet $result */
        $result = $this->migrationsTable->select(['version' => $versionNum]);
        return $result->count();
    }
}
