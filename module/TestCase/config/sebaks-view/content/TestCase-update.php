<?php

namespace TestCase;

return [
    'extend' => 'TestCase-new',
    'data' => [
        'static' => [
            'title' => 'Test Case',
            'subject' => 'Edit',
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
                    'actionRoute' => 'TestCase-update',
                ],
            ],
        ],
    ],
];