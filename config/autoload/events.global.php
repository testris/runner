<?php

return [
    'events' => [
        'Zend\Mvc\Application' => [
            Zend\Mvc\MvcEvent::EVENT_ROUTE => [
                Authentication\Checker::class,
            ],
        ],
        'TestRun' => [
            'failed' => [
                \TestRun\Listener\Notification::class,
            ],
            'broken' => [
                \TestRun\Listener\Notification::class,
            ],
            'passed' => [
                \TestRun\Listener\Notification::class,
            ],
        ],
    ],
];