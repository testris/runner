<?php

namespace Hosts;

use Hosts\Entity\Environment;

return [
    'extend' => 'admin-form-new',
    'data' => [
        'static' => [
            'method' => 'post',
        ],
        'fromParent' => [
            'result' => 'result',
        ],
    ],
    'children' => [
        'field-branch' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Branch',
                    'name' => 'branch',
                ],
                'fromParent' => [
                    'values:branch' => 'value',
                    'errors:branch' => 'errors',
                ],
            ],
        ],
        'field-site' => [
            'template' => 'application/block/form/field-text',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Site',
                    'name' => 'site',
                ],
                'fromParent' => [
                    'values:site' => 'value',
                    'errors:site' => 'errors',
                ],
            ],
        ],
        'field-environment' => [
            'template' => 'application/block/form/field-select',
            'capture' => 'fields',
            'data' => [
                'static' => [
                    'label' => 'Environment',
                    'name' => 'environment',
                    'options' => Environment::getAll(),
                ],
                'fromParent' => [
                    'environment' => 'value'
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
                    'routeName' => 'Hosts-list',
                ],
            ],
        ],
    ],
];