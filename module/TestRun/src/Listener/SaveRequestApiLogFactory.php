<?php

namespace TestRun\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SaveRequestApiLogFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SaveRequestApiLog(
            $container->get('ApiLog\Infrastructure\Repository')
        );
    }
}