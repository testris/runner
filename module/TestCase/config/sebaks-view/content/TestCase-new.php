<?php

namespace TestCase;

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Test Case',
            'subject' => 'Add new',
            'icon' => 'fa-suitcase',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'TestCase-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'TestCase-create',
                ],
            ],
        ],
    ],
];