<?php

namespace Workers;

use Application\ViewModel\ApiViewModel;

return [
    'routes' => [
        'Workers-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/workers',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'Worker-crud-list-service',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'Workers-refresh' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/workers/refresh',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => Action\RefreshAction\Service::class,
                    'allowedMethods' => ['GET'],
                    'redirectTo' => 'Workers-list',
                ],
            ],
        ],
        'Workers-update-code' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/workers/update-code',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => Action\UpdateCodeAction\Service::class,
                    'allowedMethods' => ['GET'],
                    'redirectTo' => 'Workers-list',
                ],
            ],
        ],
        'Workers-response-health-check' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/workers/response/health-check',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'routeCriteria' => 'id',
                    'service' => Action\ResponseHealthCheckAction\Service::class,
                    'viewModel' => ApiViewModel::class,
                    'allowedMethods' => ['POST'],
                ],
            ],
        ],
        'Workers-response-update-code' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/workers/response/update-code',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'routeCriteria' => 'id',
                    'service' => Action\ResponseUpdateCodeAction\Service::class,
                    'viewModel' => ApiViewModel::class,
                    'allowedMethods' => ['POST'],
                ],
            ],
        ],
    ],
];
