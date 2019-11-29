<?php

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => "mysql:dbname=web;host=mysql",
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
        'username' => 'admin',
        'password' => 'admin',
    ]
];