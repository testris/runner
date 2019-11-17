<?php

namespace TestRun;

use Application\ViewModel\ApiViewModel;
use TestRun\Action\CreateAction\ChangesValidator;
use TestRun\Action\HostsReadyAction\Service as HostsReadyAction;
use TestRun\Action\SaveOutputAction\Service as SaveOutputService;
use TestRun\Action\RerunAction\Service as RerunAction;
use TestRun\Action\SaveOutputAction\ChangesValidator as SaveOutputChangesValidator;
use TestRun\Action\ResultAction;
use TestRun\Action\CreateAction;
use TestRun\Action\UpdateAction;
use TestRun\Action\OutputAction;
use TestRun\Action\RunAction\Service as RunService;

return [
    'routes' => [
        'TestRun-list' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/test-runs',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => 'TestRun-crud-list-service',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'TestRun-read' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-runs/read/:id',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                    'routeCriteria' => 'id',
                    'service' => 'TestRun-crud-read-service',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'TestRun-result' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-runs/result/:id/view',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                    'routeCriteria' => 'id',
                    'service' => 'TestRun-crud-read-service',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'TestRun-failed-result' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-runs/failed-result/:id/view',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                    'routeCriteria' => 'id',
                    'service' => 'TestRun-crud-read-service',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'TestRun-new' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-runs/new',
                'defaults' => [
                    'controller' => 'sebaks-zend-mvc-controller',
                    'allowedMethods' => ['GET'],
                ],
            ],
        ],
        'TestRun-create' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/test-run/create',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'service' => CreateAction\Service::class,
                    'redirectTo' => 'TestRun-list',
                    'changesValidator' => ChangesValidator::class,
                ],
            ],
        ],
        'TestRun-update' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/update/:id',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => UpdateAction\Service::class,
                    'redirectTo' => 'TestRun-list',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                    'changesValidator' => ChangesValidator::class,
                ],
            ],
        ],
        'TestRun-run' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/run/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => RunService::class,
                    'redirectTo' => 'TestRun-list',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-rerun' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/re-run/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => RerunAction::class,
                    'redirectTo' => 'TestRun-list',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-output' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/output/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => OutputAction\Service::class,
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-api-log' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/api-log/:id',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-controller',
                    'routeCriteria' => 'id',
                    'service' => 'TestRun-crud-read-service',
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-save-output' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/:id/save-output',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'routeCriteria' => 'id',
                    'service' => SaveOutputService::class,
                    'viewModel' => ApiViewModel::class,
                    'changesValidator' => SaveOutputChangesValidator::class,
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-hosts-ready-callback' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/result/:id/hosts-ready',
                'defaults' => [
                    'allowedMethods' => ['GET'],
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'routeCriteria' => 'id',
                    'service' => HostsReadyAction::class,
                    'viewModel' => ApiViewModel::class,
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-result-callback' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/test-run/result/:id',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'routeCriteria' => 'id',
                    'service' => ResultAction\Service::class,
                    'viewModel' => ApiViewModel::class,
                    'changesValidator' => ResultAction\ChangesValidator::class,
                    'criteriaValidator' => 'TestRun-crud-id-validator',
                ],
            ],
        ],
        'TestRun-delete-reference' => [
            'type' => 'Segment',
            'options' => [
                'route' => '/reference/delete/:filename',
                'defaults' => [
                    'allowedMethods' => ['POST'],
                    'routeCriteria' => 'filename',
                    'controller' => 'sebaks-zend-mvc-api-controller',
                    'criteriaValidator' => Action\DeleteReferenceAction\CriteriaValidator::class,
                    'service' => Action\DeleteReferenceAction\Service::class,
                    'viewModel' => ApiViewModel::class,
                ],
            ],
        ],
    ],
];
