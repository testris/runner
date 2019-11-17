<?php

namespace TestCase;

use Application\ViewModel\ApiViewModel;

return [
    'routes' => [
        'Section-new' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/sections/new',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                ],
            ],
        ],
        'Section-create' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/sections/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'Section-crud-create-service',
                    'redirectTo' => 'TestCase-list',
                    'changesValidator' => Action\Section\CreateAction\ChangesValidator::class,
                ],
            ],
        ],

        'TestCase-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/test-cases',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'TestCase-crud-list-service',
                    'criteriaValidator' => Action\TestCase\ListAction\CriteriaValidator::class,
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'TestCase-new' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/test-cases/new',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                ],
            ],
        ],
        'TestCase-create' => [
            'type' => 'Literal',
            'options' => [
                'route'    => '/test-cases/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => Action\TestCase\CreateAction\Creator::class,
                    'redirectTo' => 'TestCase-list',
                    'changesValidator' => Action\TestCase\CreateAction\ChangesValidator::class,
                ],
            ],
        ],
        'TestCase-read' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/test-cases/read/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'TestCase-crud-read-service',
                    'criteriaValidator' => 'TestCase-crud-id-validator',
                ],
            ],
        ],
        'TestCase-update' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/test-cases/update/:id',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'TestCase\Action\TestCase\UpdateAction\Updator',
                    'redirectTo' => 'TestCase-list',
                    'changesValidator' => Action\TestCase\CreateAction\ChangesValidator::class,
                ],
            ],
        ],
        'TestCase-delete' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/test-cases/delete/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'TestCase-crud-delete-service',
                    'redirectTo' => 'TestCase-list',
                ],
            ],
        ],
        'TestCase-existing-classes' => [
            'type' => 'Segment',
            'options' => [
                'route'    => '/cases/existing-classes',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'service' => Action\ExistingClassesAction\Service::class,
                    'viewModel' => ApiViewModel::class,
                    'changesValidator' => Action\ExistingClassesAction\ChangesValidator::class,
                ],
            ],
        ],
        'TestCase-diff' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/test-cases/diff',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'TestCaseDiff-crud-list-service',
                    'criteriaValidator' => Action\TestCase\DiffAction\CriteriaValidator::class,
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
    ],
];
