<?php

use Zend\Mail\Transport\TransportInterface;
use Zend\Session\SaveHandler\SaveHandlerInterface as SessionSaveHandlerInterface;

return [
    'service_manager' => [
        'factories' => [
            SessionSaveHandlerInterface::class => \Application\SessionSaveHandlerFactory::class,
        ],
        'invokables' => [
            TransportInterface::class => \Zend\Mail\Transport\Sendmail::class,
        ]
    ],
];