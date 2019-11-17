<?php

namespace TestRun;

return [
    'extend' => 'admin-read',
    'template' => 'test-run/content/api-log',
    'viewModel' => ViewModel\ApiLogViewModel::class,
    'data' => [
        'static' => [
            'title' => 'Test Run Api log',
            'icon' => 'fa-suitcase',
        ],
        'fromGlobal' => [
            'result' => 'result',
        ],
    ],
    'children' => [
        'page-toolbar' => include "module/TestRun/config/sebaks-view/block/TestRun-PageToolbar.php",
    ],
];