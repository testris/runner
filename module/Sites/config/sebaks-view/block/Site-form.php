<?php

use Sites\Entity\SiteType;

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
                    'label' => 'Domain',
                    'name' => 'domain',
                ],
                'fromParent' => [
                    'values:domain' => 'value',
                    'errors:domain' => 'errors',
                ],
            ],
        ],
        'field-type' => [
            'template' => 'application/block/form/field-select',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Type',
                    'name' => 'type',
                    'options' => SiteType::getAll(),
                ],
                'fromParent' => [
                    'values:type' => 'value',
                    'errors:type' => 'errors',
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
                    'routeName' => 'Sites-list',
                ],
            ],
        ],
    ],
];