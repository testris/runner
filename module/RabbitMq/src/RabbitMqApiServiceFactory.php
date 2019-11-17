<?php

namespace RabbitMq;

use Interop\Container\ContainerInterface;
use PhpAmqpLib\Connection\AMQPSocketConnection;
use Zend\ServiceManager\Factory\FactoryInterface;

class RabbitMqApiServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new RabbitMqApiService(
            $container->get('Config')['rabbitMq']
        );
    }
}