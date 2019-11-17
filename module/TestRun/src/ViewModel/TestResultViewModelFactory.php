<?php

namespace TestRun\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class TestResultViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TestResultViewModel(
            $container->get('TestResult\Infrastructure\Repository'),
            $container->get('TestResultStep\Infrastructure\Repository')
        );
    }
}