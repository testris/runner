<?php

namespace Migrations\Action;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RunAllActionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $command = new RunAllAction();
        $command->initializeCommand($container->get(RunAllCommand::class));

        return $command;
    }
}
