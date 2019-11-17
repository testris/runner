<?php

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Users',
            'subject' => 'Add new',
            'icon' => 'fa-users',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'User-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Users-create',
                ],
            ],
        ],
    ],
];