<?php

namespace Sites\ViewModel;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SitesViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SitesViewModel(
            $container->get('Site\Infrastructure\Repository')
        );
    }
}