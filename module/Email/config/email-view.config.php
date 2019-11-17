<?php

namespace Email;

use Email\Template;

return [
    'layouts' => [
        'email-layout' => [
            'template' => 'email/layout/email',
            'children' => [
//                'emailHeader',
//                'emailFooter',
            ],
        ],
    ],
    'contents' => [
        Template::RUN_FAILED => [
            'layout' => 'email-layout',
            'template' => 'email/content/fail-notification',
//            'viewModel' => Email\ConfirmNewEmail\ViewModel::class,
            'children' => [
//                'emailMostPopularProfile',
//                'emailIgnoreBlock',
            ],
            'data' => [
                'fromGlobal' => [
                    'mailLogId' => 'mailLogId',
                    'to' => 'to',
                    'userId' => 'userId',
                    'name' => 'name',
                    'email' => 'email',
                    'gender' => 'gender',
                    'siteConfirmNewEmailParam' => 'siteConfirmNewEmailParam',
                    'language' => 'language',
                    'runLink' => 'runLink',
                ],
            ],
        ],
        Template::RUN_PASSED => [
            'layout' => 'email-layout',
            'template' => 'email/content/passed-notification',
            'data' => [
                'fromGlobal' => [
                    'mailLogId' => 'mailLogId',
                    'to' => 'to',
                    'userId' => 'userId',
                    'name' => 'name',
                    'email' => 'email',
                    'gender' => 'gender',
                    'siteConfirmNewEmailParam' => 'siteConfirmNewEmailParam',
                    'language' => 'language',
                    'runLink' => 'runLink',
                ],
            ],
        ],
    ],
    'blocks' => [
        'emailHeader' => [
            'template' => 'mail/email/block/header',
//            'viewModel' => Email\Common\GetMailUrl\ViewModel::class,
            'capture' => 'emailHeader',
            'data' => [
                'fromGlobal' => [
                    'mailLogId' => 'mailLogId',
                    'userId' => 'userId',
                    'to' => 'to',
                    'language' => 'language',
                    'siteUrlGetParams' => 'siteUrlGetParams',
                ],
            ],
        ],
        'emailFooter' => [
            'template' => 'mail/email/block/footer',
//            'viewModel' => Email\Common\GetMailUrl\ViewModel::class,
            'capture' => 'emailFooter',
            'data' => [
                'fromGlobal' => [
                    'mailLogId' => 'mailLogId',
                    'userId' => 'userId',
                    'to' => 'to',
                    'language' => 'language',
                    'siteUrlGetParams' => 'siteUrlGetParams',
                ],
            ],
        ],
    ],
];

