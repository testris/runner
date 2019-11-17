<?php

namespace Workers\Action\UpdateCodeAction;

use Interop\Container\ContainerInterface;
use RabbitMq\RabbitMqService;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Service(
            $container->get(RabbitMqService::class)
        );
    }
}