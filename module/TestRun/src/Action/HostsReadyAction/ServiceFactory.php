<?php

namespace TestRun\Action\HostsReadyAction;

use Interop\Container\ContainerInterface;
use RabbitMq\RabbitMqApiService;
use RabbitMq\RabbitMqService;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Service(
            $container->get('TestRun\Infrastructure\Repository'),
            $container->get(RabbitMqService::class),
            $container->get(RabbitMqApiService::class),
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository')
        );
    }
}