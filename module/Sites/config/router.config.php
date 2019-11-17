<?php

use Sites\Action\CreateAction\ChangesValidator;
use Sites\Action\ListAction\CriteriaValidator;

return [
    'routes' => [
        'Sites-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/sites',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'Site-crud-list-service',
                    'criteriaValidator' => CriteriaValidator::class,
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'Sites-new' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/sites/new',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                ],
            ],
        ],
        'Sites-create' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/sites/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'Site-crud-create-service',
                    'changesValidator' => ChangesValidator::class,
                    'redirectTo' => 'Sites-list',
                ],
            ],
        ],
        'Sites-read' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/sites/read/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'Site-crud-read-service',
                    'criteriaValidator' => 'Site-crud-id-validator',
                ],
            ],
        ],
        'Sites-update' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/sites/update/:id',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'Site-crud-update-service',
                    'changesValidator' => ChangesValidator::class,
                    'redirectTo' => 'Sites-list',
                ],
            ],
        ],
        'Sites-delete' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/sites/delete/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'Site-crud-delete-service',
                    'redirectTo' => 'Sites-list',
                ],
            ],
        ],
    ],
];
