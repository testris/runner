<?php

namespace TestRun\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class CasesTreeViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CasesTreeViewModel(
            $container->get('Section\Infrastructure\Repository'),
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get('TestResult\Infrastructure\Repository'),
            $container->get('Site\Infrastructure\Repository')
        );
    }
}