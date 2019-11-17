<?php

namespace Email\Action;

use Email\Sender;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TestEmailServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TestEmailService(
            $container->get(Sender::class)
        );
    }
}