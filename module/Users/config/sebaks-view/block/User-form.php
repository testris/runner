<?php

return [
    'extend' => 'admin-form-new',
    'data' => [
        'static' => [
            'method' => 'post',
        ],
    ],
    'children' => [
        'field-name' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                'fromParent' => [
                    'values:name' => 'value',
                    'errors:name' => 'errors',
                ],
            ],
        ],
        'field-email' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Email',
                    'name' => 'email',
                    'type' => 'email',
                ],
                'fromParent' => [
                    'values:email' => 'value',
                    'errors:email' => 'errors',
                ],
            ],
        ],
        'field-notifications' => [
            'template' => 'application/block/form/field-checkbox',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Receive notification',
                    'name' => 'notifications',
                ],
                'fromParent' => [
                    'values:notifications' => 'value',
                    'errors:notifications' => 'errors',
                ],
            ],
        ],
        'field-autoNotifications' => [
            'template' => 'application/block/form/field-checkbox',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Receive auto notification (Nightly builds)',
                    'name' => 'autoNotifications',
                ],
                'fromParent' => [
                    'values:autoNotifications' => 'value',
                    'errors:autoNotifications' => 'errors',
                ],
            ],
        ],
        'field-password' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Password',
                    'name' => 'password',
                    'type' => 'password',
//                    'help' => 'fill in only if you want to change'
                ],
                'fromParent' => [
                    'values:password' => 'value',
                    'errors:password' => 'errors',
                ],
            ],
        ],
        'field-retype-password' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Password again',
                    'name' => 'password2',
                    'type' => 'password',
//                    'help' => 'fill in only if you want to change'
                ],
                'fromParent' => [
                    'values:password2' => 'value',
                    'errors:password2' => 'errors',
                ],
            ],
        ],
        'form-button-submit' => [
            'data' => [
                'static' => [
                    'text' => 'Save',
                ],
            ],
        ],
        'form-button-cancel' => [
            'data' => [
                'static' => [
                    'routeName' => 'Users-list',
                ],
            ],
        ],
    ],
];