<?php

return [
    'contents' => [
        'Sites-list' => include 'sebaks-view/content/Sites-list.php',
        'Sites-new' => include 'sebaks-view/content/Sites-new.php',
        'Sites-create' => include 'sebaks-view/content/Sites-new.php',
        'Sites-read' => include 'sebaks-view/content/Sites-update.php',
        'Sites-update' => include 'sebaks-view/content/Sites-update.php',
    ],

    'blocks' => [
        'Site-form'=> include 'sebaks-view/block/Site-form.php',
    ],
];
