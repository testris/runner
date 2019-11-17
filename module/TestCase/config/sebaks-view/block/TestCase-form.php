<?php

namespace TestCase;

use Sites\ViewModel\SitesViewModel;
use TestCase\Entity\TestCaseStatuses;
use UseCase\ViewModel\CasesViewModel;

return [
    'extend' => 'admin-form-new',
    'data' => [
        'static' => [
            'method' => 'post',
        ],
    ],
    'children' => [
        'field-title' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Title',
                    'name' => 'title',
                ],
                'fromParent' => [
                    'values:title' => 'value',
                    'errors:title' => 'errors',
                ],
            ],
        ],
        'field-site' => [
            'template' => 'application/block/form/field-select',
            'viewModel' => SitesViewModel::class,
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Site',
                    'name' => 'siteId',
                ],
                'fromParent' => [
                    'values:siteId' => 'value',
                    'errors:siteId' => 'errors',
                ],
            ],
        ],
        'field-case' => [
            'template' => 'application/block/form/field-select-with-groups',
            'viewModel' => CasesViewModel::class,
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Use Case',
                    'name' => 'caseId',
                ],
                'fromParent' => [
                    'values:caseId' => 'value',
                    'errors:caseId' => 'errors',
                ],
            ],
        ],
        'field-auto-class' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Automated class',
                    'name' => 'automatedClass',
                ],
                'fromParent' => [
                    'values:automatedClass' => 'value',
                    'errors:automatedClass' => 'errors',
                ],
            ],
        ],
        'field-status' => [
            'template' => 'application/block/form/field-select',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Status',
                    'name' => 'status',
                    'options' => TestCaseStatuses::getAll(),
                ],
                'fromParent' => [
                    'values:status' => 'value',
                    'errors:status' => 'errors',
                ],
            ],
        ],
        'field-preconditions' => [
            'template' => 'application/block/form/field-textarea',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Preconditions',
                    'name' => 'preconditions',
                    'help' => 'Используй # для нумерации, и перевод строки для разделения шагов',
                ],
                'fromParent' => [
                    'values:preconditions' => 'value',
                    'errors:preconditions' => 'errors',
                ],
            ],
        ],
        'field-steps' => [
            'template' => 'application/block/form/field-textarea',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Steps',
                    'name' => 'steps',
                    'rows' => 10,
                    'help' => 'Используй # для нумерации, и перевод строки для разделения шагов',
                ],
                'fromParent' => [
                    'values:steps' => 'value',
                    'errors:steps' => 'errors',
                ],
            ],
        ],
        'field-result' => [
            'template' => 'application/block/form/field-textarea',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Result',
                    'name' => 'result',
                    'help' => 'Используй # для нумерации, и перевод строки для разделения шагов',
                ],
                'fromParent' => [
                    'values:result' => 'value',
                    'errors:result' => 'errors',
                ],
            ],
        ],
        'form-button-submit' => [
            'data' => [
                'static' => [
                    'text' => 'Save',
                ],
            ],
        ],
        'form-button-cancel' => [
            'data' => [
                'static' => [
                    'routeName' => 'TestCase-list',
                ],
            ],
        ],
    ],
];