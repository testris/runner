<?php

namespace TestCase;

use Application\ViewModel;

return [
    'extend' => 'TestCase-new',
    'children' => [
        'form' => [
            'viewModel' => ViewModel\UpdateFormViewModel::class,
        ],
    ],
];