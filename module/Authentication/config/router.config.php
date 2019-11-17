<?php

return [
    'routes' => [
        'auth-login' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/login',
                'defaults' => [
                    'controller' => Authentication\Action\Login::class,
                ],
            ],
        ],
        'auth-logout' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/logout',
                'defaults' => [
                    'controller' => Authentication\Action\Logout::class,
                ],
            ],
        ],
    ],
];
