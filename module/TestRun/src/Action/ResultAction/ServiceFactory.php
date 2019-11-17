<?php

namespace TestRun\Action\ResultAction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $eventManager = $container->get('EventManager');
        $eventManager->addIdentifiers(['TestRun']);

        return new Service(
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository'),
            $container->get('TestResultStep\Infrastructure\Repository'),
            $container->get('TestRun\Infrastructure\Repository'),
            $eventManager
        );
    }
}