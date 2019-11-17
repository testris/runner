<?php

return [
    'extend' => 'Sites-new',
    'data' => [
        'static' => [
            'subject' => 'Edit',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'Site-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Sites-update',
                ],
            ],
        ],
    ],
];