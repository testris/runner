<?php

namespace TestRun\Console;

use Interop\Container\ContainerInterface;
use TestRun\Action\RerunAction;
use Zend\ServiceManager\Factory\FactoryInterface;

class ReRunAllCasesOnBuildActionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $command = new ReRunAllCasesOnBuildAction();
        $command->init(
            $container->get('TestRun\Infrastructure\Repository'),
            $container->get(RerunAction\Service::class)
        );

        return $command;
    }
}