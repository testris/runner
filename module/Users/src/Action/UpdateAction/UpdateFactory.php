<?php

namespace Users\Action\UpdateAction;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class UpdateFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Update(
            $container->get("User-crud-update-service")
        );
    }
}
