<?php

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Sites',
            'subject' => 'Add new',
            'icon' => 'fa-globe',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'Site-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Sites-create',
                ],
            ],
        ],
    ],
];