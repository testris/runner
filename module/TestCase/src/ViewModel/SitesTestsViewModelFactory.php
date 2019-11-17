<?php

namespace TestCase\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SitesTestsViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SitesTestsViewModel(
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get('Site\Infrastructure\Repository')
        );
    }
}