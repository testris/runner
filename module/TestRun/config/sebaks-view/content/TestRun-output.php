<?php

namespace TestRun;

return [
    'extend' => 'admin-read',
    'template' => 'test-run/content/output',
    'viewModel' => ViewModel\OutputViewModel::class,
    'data' => [
        'static' => [
            'title' => 'Test Run Output',
            'subject' => 'Update',
            'icon' => 'fa-suitcase',
        ],
        'fromGlobal' => [
            'result' => 'result',
            'validCriteria:id' => 'id',
        ],
    ],
    'children' => [
        'page-toolbar' => include "module/TestRun/config/sebaks-view/block/TestRun-PageToolbar.php",
    ],
];