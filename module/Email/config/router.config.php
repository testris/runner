<?php

namespace Email;

use Email\Action\TestEmailService;

return [
    'routes' => [
        'Email-test' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/test-email',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => TestEmailService::class,
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
    ],
];
