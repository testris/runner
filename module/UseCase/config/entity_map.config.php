<?php

namespace UseCase;

return [
    'UseCase' => [
        'entityClass' => Entity\UseCase::class,
        'table' => 'tr_use_cases',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'section_id' => 'sectionId',
            'priority' => 'priority',
            'title' => 'title',
            'description' => 'description',
            'created' => 'created',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];