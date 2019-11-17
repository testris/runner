<?php

namespace Authentication\Action;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter as AuthAdapter;

class LoginFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $credentialCallback = function ($passwordInDatabase, $passwordProvided) {
            return password_verify($passwordProvided, $passwordInDatabase);
        };

        $authAdapter = new AuthAdapter(
            $container->get(DbAdapter::class),
            'tr_users',
            'email',
            'password',
            $credentialCallback
        );
        $viewModel = $container->get('sebaks-zend-mvc-view-model-factory');
        return new Login(
            new AuthenticationService(null, $authAdapter),
            $viewModel
        );
    }
}
