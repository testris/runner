<?php

use Zend\Router\Http\RouteMatch;

return [
    'auth' => [
        'need-authorization-callback' => function (RouteMatch $match) {
            $name = $match->getMatchedRouteName();

            $pagesWithoutAuthorization = [
                'auth-login',
                'TestRun-save-output',
                'TestRun-hosts-ready-callback',
                'TestRun-result-callback',
                'TestCase-existing-classes',
                'Workers-response-health-check',
                'Workers-response-update-code',
            ];

            if (in_array($name, $pagesWithoutAuthorization)) {
                return false;
            }

            return true;
        },

        'authorized-redirect-to-route' => function (RouteMatch $match) {
            $name = $match->getMatchedRouteName();

            if (in_array($name, ['auth-login'])) {
                return 'home';
            }
        },

        'not-authorized-redirect-to-route' => 'auth-login',
    ]
];
