<?php

return [
    'router' => include 'router.config.php',
    'sebaks-view' => include 'sebaks-view.config.php',
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'controllers' => [
        'factories' => [
            Authentication\Action\Login::class => Authentication\Action\LoginFactory::class,
            Authentication\Action\Logout::class => Authentication\Action\LogoutFactory::class,
        ],
    ],
];
