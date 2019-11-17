<?php

return [
    'view_helpers' => [
        'aliases' => [
            'isAuthorized' => Authentication\ViewHelper\IsAuthorized::class,
            'getMyself' => Users\ViewHelper\GetMyself::class,
        ],
        'factories' => [
            Authentication\ViewHelper\IsAuthorized::class => Authentication\ViewHelper\IsAuthorizedFactory::class,
            Users\ViewHelper\GetMyself::class => Users\ViewHelper\GetMyselfFactory::class,
        ],
    ],
];
