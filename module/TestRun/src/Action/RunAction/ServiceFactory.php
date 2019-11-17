<?php

namespace TestRun\Action\RunAction;

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
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository'),
            $container->get('Site\Infrastructure\Repository'),
            new Jenkins($config['jenkins']['host'], $config['jenkins']['user'], $config['jenkins']['token'])
        );
    }
}