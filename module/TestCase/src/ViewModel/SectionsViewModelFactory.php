<?php

namespace TestCase\ViewModel;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class SectionsViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SectionsViewModel(
            $container->get('Section\Infrastructure\Repository'),
            $container->get('Site\Infrastructure\Repository')
        );
    }
}