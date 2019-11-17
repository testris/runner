<?php

namespace TestRun\Console;

use Interop\Container\ContainerInterface;
use TestRun\Action\CreateAction;
use TestRun\Action\RunAction;
use Zend\ServiceManager\Factory\FactoryInterface;

class RunAllCasesOnDevelopActionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $command = new RunAllCasesOnDevelopAction();
        $command->init(
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get(CreateAction\Service::class),
            $container->get(RunAction\Service::class)
        );

        return $command;
    }
}