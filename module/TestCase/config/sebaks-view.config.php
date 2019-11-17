<?php

namespace TestCase;

return [
    'contents' => [
        'TestCase-list' => include 'sebaks-view/content/TestCase-list.php',
        'TestCase-new' => include 'sebaks-view/content/TestCase-new.php',
        'TestCase-create' => include 'sebaks-view/content/TestCase-create.php',
        'TestCase-read' => include 'sebaks-view/content/TestCase-read.php',
        'TestCase-update' => include 'sebaks-view/content/TestCase-update.php',
        'TestCase-diff' => include 'sebaks-view/content/TestCase-diff.php',

        'Section-new' => include 'sebaks-view/content/Section-new.php',
        'Section-create' => include 'sebaks-view/content/Section-create.php',
    ],

    'blocks' => [
        'Section-form'=> include 'sebaks-view/block/Section-form.php',
        'TestCase-form'=> include 'sebaks-view/block/TestCase-form.php',
    ],
];
