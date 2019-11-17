<?php

namespace TestCase\Action\TestCase\UpdateAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use TestCase\Action\TestCase\CreateAction;

class UpdatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CreateAction\Creator(
            $container->get('TestCase-crud-update-service'),
            $container->get('UseCase\Infrastructure\Repository')
        );
    }
}