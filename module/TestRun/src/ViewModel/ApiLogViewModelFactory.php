<?php

namespace TestRun\ViewModel;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Jenkins\Jenkins;

class ApiLogViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ApiLogViewModel(
            $container->get('ApiLog\Infrastructure\Repository')
        );
    }
}