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
                'field-password' => [
                    'data' => [
                        'static' => [
                            'help' => 'fill in only if you want to change'
                        ],
                        'fromParent' => [
                            '' => 'value',
                            'errors:password' => 'errors',
                        ],
                    ],
                ],
                'field-retype-password' => [
                    'data' => [
                        'static' => [
                            'help' => 'fill in only if you want to change'
                        ],
                        'fromParent' => [
                            '' => 'value',
                            'errors:password' => 'errors',
                        ],
                    ],
                ],
            ],
            'data' => [
                'static' => [
                    'actionRoute' => 'Users-update',
                ],
            ],
        ],
    ],
];