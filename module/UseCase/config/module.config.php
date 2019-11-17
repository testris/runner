<?php

namespace UseCase;

return [
    'router' => include 'router.config.php',
    'sebaks-view' => include 'sebaks-view.config.php',
    'entity_map' => require 'entity_map.config.php',
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
