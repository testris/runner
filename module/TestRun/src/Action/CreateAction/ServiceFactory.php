<?php

namespace TestRun\Action\CreateAction;

use Interop\Container\ContainerInterface;
use Users\ViewHelper\GetMyself;
use Zend\ServiceManager\Factory\FactoryInterface;
use TestRun\Action\RunAction;
use TestRun\Action\HostsReadyAction;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Service(
            $container->get('TestRun\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository'),
            $container->get(RunAction\Service::class),
            $container->get(HostsReadyAction\Service::class),
            $container->get(GetMyself::class)
        );
    }
}