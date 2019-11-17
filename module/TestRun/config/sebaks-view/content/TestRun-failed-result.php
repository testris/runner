<?php

namespace TestRun;

use TestRun\Entity\TestRunStatuses;

return [
    'layout' => 'admin-layout',
    'template' => 'test-run/content/result',
    'viewModel' => ViewModel\TestResultViewModel::class,
    'data' => [
        'static' => [
            'title' => 'Test Runs',
            'icon' => 'fa-tasks',
            'criteria' => [
                'status_in' => [TestRunStatuses::FAILED, TestRunStatuses::BROKEN],
            ]
        ],
        'fromGlobal' => [
            'result' => 'result',
        ],
    ],
    'children' => [
        'page-toolbar' => include "module/TestRun/config/sebaks-view/block/TestRun-PageToolbar.php",
        'sections' => [
            'template' => 'test-run/block/sections-result',
            'viewModel' => ViewModel\
            CasesTreeViewModel::class,
            'capture' => 'sections',
            'data' => [
                'fromGlobal' => [
                    'result' => 'result',
                ],
                'static' => [
                    'criteria' => [
                        'status_in' => [TestRunStatuses::FAILED, TestRunStatuses::BROKEN],
                    ]
                ],
            ],
        ],
    ],
];