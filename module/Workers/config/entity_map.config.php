<?php

namespace Workers;

return [
    'Worker' => [
        'entityClass' => Entity\Worker::class,
        'table' => 'tr_workers',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'ip' => 'ip',
            'health_check_date' => 'healthCheckDate',
            'last_command' => 'lastCommand',
            'last_response' => 'lastResponse',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
            'ip' => 'ip_equalTo',
        ],
    ],
];