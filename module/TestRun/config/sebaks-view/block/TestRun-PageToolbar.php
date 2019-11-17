<?php

namespace TestRun;

use Application\ViewModel\EditButtonViewModel;
use TestRun\ViewModel\EditButtonViewModel as TestRunEditButtonViewModel;
use TestRun\ViewModel\RunButtonViewModel;
use TestRun\ViewModel\TestRunPageToolbarViewModel;

return [
    'template' => 'application/block/page-toolbar',
    'viewModel' => TestRunPageToolbarViewModel::class,
    'capture' => 'pageToolbar',
    'data' => [
        'fromGlobal' => [
            'criteria:id' => 'id',
            'result' => 'result',
        ],
    ],
    'children' => [
        'run-button' => [
            'template' => 'test-run/block/run-button',
            'viewModel' => RunButtonViewModel::class,
            'capture' => 'button',
            'data' => [
                'static' => [
                    'color' => 'primary',
                    'icon' => 'fa-play',
                    'text' => 'Run',
                    'routeName' => 'TestRun-run',
                ],
                'fromParent' => [
                    'id' => 'id',
                    'status' => 'status',
                ],
            ],
        ],
        'result-button' => [
            'template' => 'application/block/link-button',
            'viewModel' => EditButtonViewModel::class,
            'capture' => 'button',
            'data' => [
                'static' => [
                    'color' => 'info',
                    'icon' => 'fa-tasks',
                    'text' => 'Results',
                    'routeName' => 'TestRun-result',
                ],
                'fromParent' => [
                    'id' => 'id'
                ],
            ],
        ],
        'edit-button' => [
            'template' => 'application/block/link-button',
            'viewModel' => TestRunEditButtonViewModel::class,
            'capture' => 'button',
            'data' => [
                'static' => [
                    'color' => 'success',
                    'icon' => 'fa-pencil-square-o',
                    'text' => 'Edit',
                    'routeName' => 'TestRun-read',
                ],
                'fromParent' => [
                    'id' => 'id',
                    'status' => 'status',
                ],
            ],
        ],
        'output-button' => [
            'template' => 'application/block/link-button',
            'viewModel' => EditButtonViewModel::class,
            'capture' => 'button',
            'data' => [
                'static' => [
                    'color' => 'default',
                    'icon' => 'fa-terminal',
                    'text' => 'Output',
                    'routeName' => 'TestRun-output',
                ],
                'fromParent' => [
                    'id' => 'id',
                ],
            ],
        ],
        'api-log-button' => [
            'template' => 'application/block/link-button',
            'viewModel' => EditButtonViewModel::class,
            'capture' => 'button',
            'data' => [
                'static' => [
                    'color' => 'warning',
                    'icon' => 'fa-exchange',
                    'text' => 'Api log',
                    'routeName' => 'TestRun-api-log',
                ],
                'fromParent' => [
                    'id' => 'id',
                ],
            ],
        ],
    ],
];