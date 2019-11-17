<?php

namespace TestCase\Action\TestCase\CreateAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CreatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Creator(
            $container->get('TestCase-crud-create-service'),
            $container->get('UseCase\Infrastructure\Repository')
        );
    }
}