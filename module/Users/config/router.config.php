<?php

return [
    'routes' => [
        'Users-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/users',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'User-crud-list-service',
//                    'criteriaValidator' => CriteriaValidator::class,
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'Users-new' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/users/new',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                ],
            ],
        ],
        'Users-create' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/users/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => Users\Action\CreateAction\Creator::class,
                    'redirectTo' => 'Users-list',
                    'changesValidator' => Users\Action\CreateAction\ChangesValidator::class,
                ],
            ],
        ],
        'Users-read' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/users/read/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'User-crud-read-service',
                    'criteriaValidator' => 'User-crud-id-validator',
                ],
            ],
        ],
        'Users-update' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/users/update/:id',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => Users\Action\UpdateAction\Update::class,
                    'redirectTo' => 'Users-list',
                    'changesValidator' => Users\Action\UpdateAction\ChangesValidator::class,
                ],
            ],
        ],
        'Users-delete' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/users/delete/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'User-crud-delete-service',
                    'redirectTo' => 'Users-list',
                ],
            ],
        ],
    ],
];
