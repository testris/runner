<?php

namespace TestRun\Action\OutputAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Jenkins\Jenkins;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        return new Service(
            $container->get('TestRun\Infrastructure\Repository'),
            new Jenkins($config['jenkins']['host'], $config['jenkins']['user'], $config['jenkins']['token'])
        );
    }
}