<?php

namespace TestCase;

use TestCase\ViewModel\SectionsViewModel;

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
        'field-parent' => [
            'template' => 'application/block/form/field-select',
            'viewModel' => SectionsViewModel::class,
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Parent',
                    'name' => 'parentId',
                    'additionalOptions' => ['0' => 'Root'],
                ],
                'fromParent' => [
                    'values:parentId' => 'value',
                    'errors:parentId' => 'errors',
                ],
            ],
        ],
        'field-name' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                'fromParent' => [
                    'values:name' => 'value',
                    'errors:name' => 'errors',
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