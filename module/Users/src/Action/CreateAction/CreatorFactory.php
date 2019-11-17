<?php

namespace Users\Action\CreateAction;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class CreatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Creator(
            $container->get("User-crud-create-service")
        );
    }
}
