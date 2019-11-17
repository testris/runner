<?php

namespace TestCase;

use TestCase\Entity\Section;
use TestCase\ViewModel\SectionsViewModel;
use UseCase\Entity\UseCasePriority;

return [
    'extend' => 'admin-form-new',
    'data' => [
        'static' => [
            'method' => 'post',
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
                    'name' => 'sectionId',
                    'parentId' => Section::USE_CASES,
                ],
                'fromParent' => [
                    'values:sectionId' => 'value',
                    'errors:sectionId' => 'errors',
                ],
            ],
        ],
        'field-priority' => [
            'template' => 'application/block/form/field-select',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Priority',
                    'name' => 'priority',
                    'options' => UseCasePriority::getAll(),
                ],
                'fromParent' => [
                    'values:priority' => 'value',
                    'errors:priority' => 'errors',
                ],
            ],
        ],
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
        'field-description' => [
            'template' => 'application/block/form/field-textarea',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Description',
                    'name' => 'description',
                ],
                'fromParent' => [
                    'values:description' => 'value',
                    'errors:description' => 'errors',
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
                    'routeName' => 'UseCase-list',
                ],
            ],
        ],
    ],
];