<?php

namespace TestCase\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class TestsWithoutCaseViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TestsWithoutCaseViewModel(
            $container->get('TestCase\Infrastructure\Repository')
        );
    }
}