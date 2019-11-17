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