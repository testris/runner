<?php

return [
    'router' => include 'router.config.php',
    'email' => [
        'templates' => include 'templates.config.php',
        'email-view' => include 'email-view.config.php',

        'sendFrom' => 'testrunner@runner.com',
        'sendFromName' => 'TestRunner',
        'path' => __DIR__ . '/../../../data/mail/',
    ],

    'view_manager' => [
        'template_path_stack' => [
            'mail' => __DIR__ . '/../view',
        ],
    ],
];
