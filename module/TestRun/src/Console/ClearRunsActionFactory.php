<?php

namespace TestRun\Console;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\Factory\FactoryInterface;

class ClearRunsActionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $command = new ClearRunsAction();
        $command->init($container->get(Adapter::class));

        return $command;
    }
}