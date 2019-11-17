<?php

namespace UseCase;

use TestCase\Entity\Section;
use TestCase\ViewModel\SectionsViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'use-case/content/list',
    'data' => [
        'static' => [
            'title' => 'Use Cases',
            'icon' => 'fa-briefcase',
        ],
    ],
    'children' => [
        'page-toolbar' => [
            'template' => 'application/block/page-toolbar',
            'capture' => 'pageToolbar',
            'children' => [
                'button-new-use-case' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-new-entity',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-plus',
                            'color' => 'success',
                            'text' => 'Add use case',
                            'routeName' => 'UseCase-new',
                        ],
                    ],
                ],
            ],
        ],
        'sections' => [
            'template' => 'use-case/block/sections',
            'viewModel' => SectionsViewModel::class,
            'capture' => 'sections',
            'data' => [
                'fromGlobal' => [
                    'result' => 'result',
                ],
                'static' => [
                    'parentId' => Section::USE_CASES,
                ],
            ],
        ],
    ],
];