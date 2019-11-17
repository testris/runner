<?php

return [
    'extend' => 'Users-new',
    'data' => [
        'static' => [
            'subject' => 'Edit',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'User-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Users-update',
                ],
            ],
        ],
    ],
];