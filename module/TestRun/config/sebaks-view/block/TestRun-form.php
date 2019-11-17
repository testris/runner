<?php

namespace TestRun;

use Hosts\Entity\Environment;
use TestCase\ViewModel\CasesTreeViewModel;

return [
    'extend' => 'admin-form-new',
    'data' => [
        'static' => [
            'method' => 'post',
        ],
        'fromParent' => [
            'result' => 'result',
        ],
    ],
    'children' => [
        'field-title' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Name',
                    'name' => 'title',
                ],
                'fromParent' => [
                    'values:title' => 'value',
                    'errors:title' => 'errors',
                ],
            ],
        ],
        'field-environment' => [
            'template' => 'application/block/form/field-select',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Environment',
                    'name' => 'environment',
                    'options' => Environment::getAll(),
                ],
                'fromParent' => [
                    'values:environment' => 'value'
                ],
            ],
        ],
        'field-branch' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Branch',
                    'name' => 'branch',
                    'help' => 'For staging leave empty'
                ],
                'fromParent' => [
                    'values:branch' => 'value',
                    'errors:branch' => 'errors',
                ],
            ],
        ],
        'sections-list' => [
            'template' => 'test-run/block/sections-list',
            'capture' => 'fields',
            'data' => [
                'fromParent' => [
                    'values' => 'values',
                    'errors' => 'errors',
                ],
            ],
            'children' => [
                'sections' => [
                    'template' => 'test-run/block/sections',
                    'viewModel' => CasesTreeViewModel::class,
                    'capture' => 'sections',
                    'data' => [
                        'fromParent' => [
                            'values:caseIds' => 'value',
                            'errors:caseIds' => 'errors',
                        ],
                    ],
                ]
            ],
        ],
        'form-button-submit' => [
            'data' => [
                'static' => [
                    'text' => 'Save and run',
                ],
            ],
        ],
        'form-button-cancel' => [
            'data' => [
                'static' => [
                    'routeName' => 'TestRun-list',
                ],
            ],
        ],
    ],
];