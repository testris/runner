<?php

return [
    'capture' => 'UseCase-block',
    'template' => 'use-case/block/block',
    'viewModel' => UseCase\ViewModel\BlockViewModel::class,
    'data' => [
        'static' => [
            'method' => 'post',
        ],
    ],
    'children' => [
    ],
];