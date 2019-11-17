<?php

use Zend\Session;

return [
    'session' => [
        'config' => [
            'class' => Session\Config\SessionConfig::class,
        ],
        'storage' => Session\Storage\SessionArrayStorage::class,
        'validators' => [
             //Session\Validator\RemoteAddr::class,
             //Session\Validator\HttpUserAgent::class,
        ],
    ],

    'session_config' => [
        // Session cookie will expire in 3 days.
        'cookie_lifetime' => 60*60*24*3,
        // Session data will be stored on server maximum for 30 days.
        'gc_maxlifetime'     => 60*60*24*30,
    ],

    'session_storage' => [
        'type' => Session\Storage\SessionArrayStorage::class
    ],
];
