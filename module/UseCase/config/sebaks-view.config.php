<?php

namespace UseCase;

return [
    'contents' => [
        'UseCase-list' => include 'sebaks-view/content/UseCase-list.php',
        'UseCase-new' => include 'sebaks-view/content/UseCase-new.php',
        'UseCase-create' => include 'sebaks-view/content/UseCase-create.php',
        'UseCase-read' => include 'sebaks-view/content/UseCase-read.php',
        'UseCase-update' => include 'sebaks-view/content/UseCase-update.php',
    ],

    'blocks' => [
        'UseCase-form'=> include 'sebaks-view/block/UseCase-form.php',
    ],
];
