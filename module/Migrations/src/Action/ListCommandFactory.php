<?php

namespace Migrations\Action;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\TableGateway\TableGateway;

class ListCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        return new ListCommand(
            $config['migration'],
            new TableGateway('migrations', $container->get(Adapter::class))
        );
    }
}
