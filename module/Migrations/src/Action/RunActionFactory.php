<?php

namespace Migrations\Action;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RunActionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $command = new RunAction();
        $command->initializeCommand($container->get(RunCommand::class));

        return $command;
    }
}
