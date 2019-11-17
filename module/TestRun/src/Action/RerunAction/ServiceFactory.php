<?php

namespace TestRun\Action\RerunAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use TestRun\Action\CreateAction;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Service(
            $container->get('TestRun\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository'),
            $container->get(CreateAction\Service::class)
        );
    }
}