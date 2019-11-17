<?php

namespace Sites;

return [
    
    'Site' => [
        'entityClass' => Entity\Site::class,
        'collectionClass' => Entity\SiteCollection::class,
        'table' => 'tr_sites',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'domain' => 'domain',
            'type' => 'type',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];