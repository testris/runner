<?php

namespace TestCase;

return [
    'extend' => 'admin-read',
    'data' => [
        'static' => [
            'title' => 'Section',
            'subject' => 'Add new',
            'icon' => 'fa-sitemap',
        ],
    ],
    'children' => [
        'form' => [
            'extend' => 'Section-form',
            'children' => [
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Section-create',
                ],
            ],
        ],
    ],
];