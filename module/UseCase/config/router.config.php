<?php

namespace UseCase;

use TestCase\Action\TestCase\ListAction\CriteriaValidator;

return [
    'routes' => [
        'UseCase-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/use-cases',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'UseCase-crud-list-service',
                    'criteriaValidator' => CriteriaValidator::class,
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'UseCase-new' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/use-cases/new',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                ],
            ],
        ],
        'UseCase-create' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/use-cases/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'UseCase-crud-create-service',
                    'redirectTo' => 'UseCase-list',
                    'changesValidator' => Action\UseCase\CreateAction\ChangesValidator::class,
                ],
            ],
        ],
        'UseCase-read' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/use-cases/read/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'UseCase-crud-read-service',
                    'criteriaValidator' => 'UseCase-crud-id-validator',
                ],
            ],
        ],
        'UseCase-update' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/use-cases/update/:id',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'UseCase-crud-update-service',
                    'redirectTo' => 'UseCase-list',
                    'changesValidator' => Action\UseCase\CreateAction\ChangesValidator::class,
                ],
            ],
        ],
        'UseCase-delete' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/use-cases/delete/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'UseCase-crud-delete-service',
                    'redirectTo' => 'UseCase-list',
                ],
            ],
        ],
    ],
];
