<?php

namespace TestRun\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class StartedViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new StartedViewModel([
            'userRepository' => $container->get('User\Infrastructure\Repository')
        ]);
    }
}