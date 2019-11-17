<?php

namespace Hosts\Action\CreateAction;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Jenkins\Jenkins;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        return new Service(
            $container->get('Hosts\Infrastructure\Repository'),
            new Jenkins($config['jenkins']['host'], $config['jenkins']['user'], $config['jenkins']['token'])
        );
    }
}