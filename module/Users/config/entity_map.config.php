<?php

namespace Users;

return [
    'User' => [
        'entityClass' => Entity\User::class,
        'table' => 'tr_users',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'email' => 'email',
            'password' => 'password',
            'name' => 'name',
            'notifications' => 'notifications',
            'auto_notifications' => 'autoNotifications',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];