<?php

namespace TestCase;

use Application\ViewModel;

return [
    'extend' => 'Section-new',
    'children' => [
        'form' => [
            'viewModel' => ViewModel\UpdateFormViewModel::class,
        ],
    ],
];