<?php

namespace TestRun;

return [
    'layout' => 'admin-layout',
    'template' => 'test-run/content/result',
    'viewModel' => ViewModel\TestResultViewModel::class,
    'data' => [
        'static' => [
            'title' => 'Test Runs',
            'icon' => 'fa-tasks',
        ],
        'fromGlobal' => [
            'result' => 'result',
        ],
    ],
    'children' => [
        'page-toolbar' => include "module/TestRun/config/sebaks-view/block/TestRun-PageToolbar.php",
        'sections' => [
            'template' => 'test-run/block/sections-result',
            'viewModel' => ViewModel\CasesTreeViewModel::class,
            'capture' => 'sections',
            'data' => [
                'fromGlobal' => [
                    'result' => 'result',
                ],
            ],
        ],
    ],
];