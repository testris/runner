<?php

namespace TestRun\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class OutputViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new OutputViewModel(
            $container->get('TestRunOutput\Infrastructure\Repository')
        );
    }
}