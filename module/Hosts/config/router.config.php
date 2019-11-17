<?php

namespace Hosts;

use Application\ViewModel\ApiViewModel;
use Hosts\Action\CreateAction\ChangesValidator;
use Hosts\Action\CreateAction\Service;
use Hosts\Action\StatusAction\Service as StatusService;

return [
    'routes' => [
        'Hosts-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/hosts',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'Hosts-crud-list-service',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'Hosts-new' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/hosts/new',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'Hosts-create' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/hosts/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => Service::class,
                    'redirectTo' => 'Hosts-list',
                    'changesValidator' => ChangesValidator::class,
                ],
            ],
        ],
        'Job-status' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/jobs/status',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'service' => StatusService::class,
                    'viewModel' => ApiViewModel::class,
                ],
            ],
        ],
    ],
];
