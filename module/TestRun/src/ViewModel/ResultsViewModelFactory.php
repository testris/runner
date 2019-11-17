<?php

namespace TestRun\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ResultsViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ResultsViewModel(
            $container->get('Zend\Db\Adapter\Adapter')
        );
    }
}