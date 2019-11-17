<?php

namespace TestRun;

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Test Run',
            'subject' => 'Update',
            'icon' => 'fa-suitcase',
        ],
    ],
    'children' => [
        'page-toolbar' => include "module/TestRun/config/sebaks-view/block/TestRun-PageToolbar.php",
        'form' => [
            'extend' => 'TestRun-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'TestRun-update',
                ],
            ],
        ],
    ],
];