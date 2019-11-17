<?php

namespace TestRun\Action\UpdateAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Service(
            $container->get('TestRun\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository')
        );
    }
}