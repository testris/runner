<?php

namespace AdminV2\Application;

use UseCase\Entity\UseCasePriority;

return [
    'contents' => [
        'home' => [
            'layout' => 'admin-layout',
            'template' => 'application/content/index',
            'children' => [
                'high-block' => [
                    'extend' => 'UseCase-block',
                    'capture' => 'high-block',
                    'children' => [
                    ],
                    'data' => [
                        'static' => [
                            'priority' => UseCasePriority::HIGH,
                            'title' => '<i class="icon-fire"></i> <i class="icon-fire"></i> <i class="icon-fire"></i> High',
                            'portlet-color' => 'red',
                            'label-color' => 'label-danger',
                        ],
                    ],
                ],
                'mid-block' => [
                    'extend' => 'UseCase-block',
                    'capture' => 'mid-block',
                    'children' => [
                    ],
                    'data' => [
                        'static' => [
                            'priority' => UseCasePriority::MEDIUM,
                            'title' => '<i class="icon-fire"></i> <i class="icon-fire"></i> Mid',
                            'portlet-color' => 'green-jungle',
                            'label-color' => 'label-success',
                        ],
                    ],
                ],
                'low-block' => [
                    'extend' => 'UseCase-block',
                    'capture' => 'low-block',
                    'children' => [
                    ],
                    'data' => [
                        'static' => [
                            'priority' => UseCasePriority::LOW,
                            'title' => '<i class="icon-fire"></i> Low',
                            'portlet-color' => 'blue',
                            'label-color' => 'label-info',
                        ],
                    ],
                ],
                'sites-tests' => [
                    'capture' => 'sites-tests',
                    'template' => 'test-case/block/sites-tests',
                    'viewModel' => \TestCase\ViewModel\SitesTestsViewModel::class,
                ],
            ],
        ],
        '403' => [
            'layout' => 'admin-layout',
            'template' => 'error/403',
        ],
        '404' => [
            'layout' => 'admin-layout',
            'template' => 'error/404',
        ],
    ],

    'blocks' => [
        'UseCase-block'=> include 'sebaks-view/block/UseCase-block.php',
    ],
];
