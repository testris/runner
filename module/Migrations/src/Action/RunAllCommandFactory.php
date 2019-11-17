<?php

namespace Migrations\Action;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RunAllCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new RunAllCommand(
            $container->get(ListCommand::class),
            $container->get(RunCommand::class)
        );
    }
}
