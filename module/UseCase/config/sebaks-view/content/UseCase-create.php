<?php

namespace UseCase;

use Application\ViewModel;

return [
    'extend' => 'UseCase-new',
    'children' => [
        'form' => [
            'viewModel' => ViewModel\UpdateFormViewModel::class,
        ],
    ],
];