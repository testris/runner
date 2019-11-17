<?php

namespace TestCase;

use TestCase\ViewModel\SectionsViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'test-case/content/list',
    'data' => [
        'static' => [
            'title' => 'Test Cases',
            'icon' => 'fa-suitcase',
        ],
    ],
    'children' => [
        'page-toolbar' => [
            'template' => 'application/block/page-toolbar',
            'capture' => 'pageToolbar',
            'children' => [
                'button-new-entity' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-new-entity',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-plus',
                            'color' => 'success',
                            'text' => 'Add section',
                            'routeName' => 'Section-new',
                        ],
                    ],
                ],
                'button-MailLabel-list' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-new-entity',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-suitcase',
                            'color' => 'primary',
                            'text' => 'Add case',
                            'routeName' => 'TestCase-new',
                        ],
                    ],
                ],
            ],
        ],
        'sections' => [
            'template' => 'test-case/block/sections',
            'viewModel' => SectionsViewModel::class,
            'capture' => 'sections',
            'data' => [
                'static' => [
                    'parentId' => 0, // Section::USE_CASES,
                ],
                'fromGlobal' => [
                    'result' => 'result',
                ],
            ],
        ],
    ],
];