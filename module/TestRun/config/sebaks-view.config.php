<?php

namespace TestRun;

return [
    'contents' => [
        'TestRun-list' => include 'sebaks-view/content/TestRun-list.php',
        'TestRun-read' => include 'sebaks-view/content/TestRun-read.php',
        'TestRun-new' => include 'sebaks-view/content/TestRun-new.php',
        'TestRun-create' => include 'sebaks-view/content/TestRun-new.php',
        'TestRun-update' => include 'sebaks-view/content/TestRun-update.php',
        'TestRun-result' => include 'sebaks-view/content/TestRun-result.php',
        'TestRun-failed-result' => include 'sebaks-view/content/TestRun-failed-result.php',
        'TestRun-output' => include 'sebaks-view/content/TestRun-output.php',
        'TestRun-api-log' => include 'sebaks-view/content/TestRun-api-log.php',
    ],

    'blocks' => [
        'TestRun-form' => include 'sebaks-view/block/TestRun-form.php',
    ],
];
