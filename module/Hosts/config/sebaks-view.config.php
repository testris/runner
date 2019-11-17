<?php

namespace Hosts;

return [
    'contents' => [
        'Hosts-list' => include 'sebaks-view/content/Hosts-list.php',
        'Hosts-new' => include 'sebaks-view/content/Hosts-new.php',
        'Hosts-create' => include 'sebaks-view/content/Hosts-new.php',
    ],
    'blocks' => [
        'Hosts-form' => include 'sebaks-view/block/Hosts-form.php',
    ],
];
