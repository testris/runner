<?php

namespace UseCase\ViewModel;

use Interop\Container\ContainerInterface;
use TestCase\ViewModel\SectionsViewModel;
use Zend\ServiceManager\Factory\FactoryInterface;

class CasesViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CasesViewModel(
            $container->get('UseCase\Infrastructure\Repository'),
            $container->get(SectionsViewModel::class)
        );
    }
}