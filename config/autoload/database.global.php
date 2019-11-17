<?php

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => "mysql:dbname=test_runner;host=localhost",
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
        'username' => 'test_runner',
        'password' => '111',
    ]
];