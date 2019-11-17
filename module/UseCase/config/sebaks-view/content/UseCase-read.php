<?php

namespace UseCase;

return [
    'extend' => 'UseCase-new',
    'data' => [
        'static' => [
            'title' => 'Use Case',
            'subject' => 'Edit',
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
                    'actionRoute' => 'UseCase-update',
                ],
            ],
        ],
    ],
];