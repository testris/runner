<?php

namespace Users\ViewHelper;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;

class GetMyselfFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new GetMyself(
            new AuthenticationService(),
            $container->get('User\Infrastructure\Repository')
        );
    }
}
