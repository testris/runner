<?php

namespace TestRun;

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Test Run',
            'subject' => 'Add new',
            'icon' => 'fa-suitcase',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'Hosts-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Hosts-create',
                ],
            ],
        ],
    ],
];