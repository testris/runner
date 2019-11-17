<?php

namespace UseCase;

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Use Case',
            'subject' => 'Add new',
            'icon' => 'fa-briefcase',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'UseCase-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'UseCase-create',
                ],
            ],
        ],
    ],
];