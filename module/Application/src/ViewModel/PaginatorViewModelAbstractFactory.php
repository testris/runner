<?php

namespace Application\ViewModel;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class PaginatorViewModelAbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        $namespaceParts = explode('\\', $requestedName);
        return count($namespaceParts) == 3
            && $namespaceParts[1] == 'ViewModel'
            && $namespaceParts[2] == 'PaginatorViewModel';
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $namespaceParts = explode('\\', $requestedName);
        $entity = $namespaceParts[0];

        if ($container->has(ucfirst($entity) . "\\Infrastructure\\Repository")) {
            $repository = $container->get(ucfirst($entity) . "\\Infrastructure\\Repository");
        } else {
            throw new \RuntimeException(ucfirst($entity) . "\\Infrastructure\\Repository - not found");
        }

        return new PaginatorViewModel($repository);
    }
}
