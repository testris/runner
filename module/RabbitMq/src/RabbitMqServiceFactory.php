<?php

namespace RabbitMq;

use Interop\Container\ContainerInterface;
use PhpAmqpLib\Connection\AMQPSocketConnection;
use Zend\ServiceManager\Factory\FactoryInterface;

class RabbitMqServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['rabbitMq'];

        return new RabbitMqService(
            new AMQPSocketConnection($config['host'], $config['port'], $config['username'], $config['password'])
        );
    }
}