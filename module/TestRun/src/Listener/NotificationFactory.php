<?php

namespace TestRun\Listener;

use Email\Sender;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class NotificationFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Notification(
            $container->get(Sender::class),
            $container->get('User\Infrastructure\Repository'),
            $container->get('config')['server-url']
        );
    }
}