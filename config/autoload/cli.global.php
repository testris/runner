<?php

return [
    'cli' => [
        'commands' => [
            Migrations\Action\InstallAction::class,
            Migrations\Action\ListAction::class,
            Migrations\Action\RunAction::class,
            Migrations\Action\RunAllAction::class,
            Migrations\Action\CreateAction::class,

            TestRun\Console\RunAllCasesOnDevelopAction::class,
            TestRun\Console\ReRunAllCasesOnDevelopAction::class,

            TestRun\Console\RunAllCasesOnBuildAction::class,
            TestRun\Console\ReRunAllCasesOnBuildAction::class,

            TestRun\Console\ClearRunsAction::class,
        ],
    ]
];