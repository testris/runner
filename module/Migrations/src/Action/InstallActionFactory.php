<?php

namespace Migrations\Action;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class InstallActionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $command = new InstallAction();
        $command->initializeCommand($container->get(InstallCommand::class));

        return $command;
    }
}
