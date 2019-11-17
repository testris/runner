<?php

namespace TestRun\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SaveResponseApiLogFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SaveResponseApiLog(
            $container->get('ApiLog\Infrastructure\Repository')
        );
    }
}