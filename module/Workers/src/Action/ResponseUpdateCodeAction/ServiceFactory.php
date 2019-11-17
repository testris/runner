<?php

namespace Workers\Action\ResponseUpdateCodeAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Service(
            $container->get('Worker\Infrastructure\Repository')
        );
    }
}