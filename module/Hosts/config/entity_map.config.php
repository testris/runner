<?php

namespace Hosts;

return [
    'Hosts' => [
        'entityClass' => Entity\Hosts::class,
        'table' => 'tr_hosts',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'branch' => 'branch',
            'site' => 'site',
            'creator' => 'creator',
            'environment' => 'environment',
            'created' => 'created',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];