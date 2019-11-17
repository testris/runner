<?php

namespace UseCase\ViewModel;

use Interop\Container\ContainerInterface;
use TestCase\ViewModel\SectionsViewModel;
use Zend\ServiceManager\Factory\FactoryInterface;

class BlockViewModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new BlockViewModel(
            $container->get('UseCase\Infrastructure\Repository'),
            $container->get('TestCase\Infrastructure\Repository'),
            $container->get('Site\Infrastructure\Repository'),
            $container->get(SectionsViewModel::class)
        );
    }
}