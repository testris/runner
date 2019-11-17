<?php

namespace TestRun;

use Application\ViewModel\TableRowViewModel;
use Application\ViewModel\EditButtonViewModel;
use TestRun\ViewModel\EditButtonViewModel as TestRunEditButtonViewModel;
use TestRun\ViewModel\FailedResultsButtonViewModel;
use TestRun\ViewModel\ResultsViewModel;
use TestRun\ViewModel\RunButtonViewModel;
use Hosts\Entity\Environment;
use TestRun\Entity\TestRunStatuses;
use TestRun\ViewModel\ExecutedViewModel;
use TestRun\ViewModel\StartedViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'application/content/list',
    'data' => [
        'static' => [
            'title' => 'Test Runs',
            'icon' => 'fa-tasks',
        ],
    ],
    'children' => [
        'page-toolbar' => [
            'template' => 'application/block/page-toolbar',
            'capture' => 'pageToolbar',
            'children' => [
                'button-add-run' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-new-entity',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-plus',
                            'color' => 'primary',
                            'text' => 'Add run',
                            'routeName' => 'TestRun-new',
                        ],
                    ],
                ],
            ],
        ],
        'table' => [
            'extend' => 'admin-table',
            'children' => [
                'table-head-row' => [
                    'template' => 'application/block/table/tr',
                    'children' => [
                        'table-th-id' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Id',
                                    'width' => '5%',
                                    'orderRow' => 'id',
                                    'defaultSort' => 1,
                                ],
                                'fromGlobal' => [
                                    'validCriteria' => 'validCriteria',
                                ],
                            ],
                        ],

                        'table-th-name' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Name',
                                    'width' => '35%',
                                ],
                            ],
                        ],

                        'table-th-results' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Results',
                                    'width' => '10%',
                                    'align' => 'right'
                                ],
                            ],
                        ],

                        'table-th-environment' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Env',
                                    'width' => '5%',
                                    'align' => 'center'
                                ],
                            ],
                        ],
                        'table-th-branch' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Branch',
                                    'width' => '10%',
                                ],
                            ],
                        ],

                        'table-th-started' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Started',
                                    'width' => '10%',
                                ],
                            ],
                        ],

                        'table-th-executed' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Executed',
                                    'width' => '10%',
                                ],
                            ],
                        ],

                        'table-th-status' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Status',
                                    'width' => '10%',
                                ],
                            ],
                        ],

                        'table-th-actions' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Actions',
                                    'width' => '5%',
                                ],
                            ],
                        ],
                    ],
                ],
                'table-body-row' => [
                    'viewModel' => TableRowViewModel::class,
                    'template' => 'application/block/table/tr',
                    'data' => [
                        'fromParent' => 'row',
                    ],
                    'children' => [
                        'table-td-id' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['id' => 'value'],
                            ],
                        ],

                        'table-td-name' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'title' => 'value'
                                ],
                            ],
                        ],
                        'table-td-results' => [
                            'template' => 'test-run/block/table/td-results',
                            'viewModel' => ResultsViewModel::class,
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'id' => 'id',
                                ],
                            ],
                        ],
                        'table-td-environment' => [
                            'template' => 'application/block/table/td-labeled',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'align' => 'center',
                                    'colorValueMap' => [
                                        1 => 'warning',
                                        2 => 'primary',
                                        3 => 'success',
                                    ],
                                    'textValueMap' => Environment::getAll(),
                                ],
                                'fromParent' => ['environment' => 'value'],
                            ],
                        ],
                        'table-td-branch' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'branch' => 'value'
                                ],
                            ],
                        ],
                        'table-td-started' => [
                            'template' => 'test-run/block/table/td-started',
                            'viewModel' => StartedViewModel::class,
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'started' => 'value',
                                    'runBy' => 'userId',
                                ],
                            ],
                        ],
                        'table-td-executed' => [
                            'template' => 'application/block/table/td',
                            'viewModel' => ExecutedViewModel::class,
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'ended' => 'ended',
                                    'started' => 'started',
                                ],
                            ],
                        ],
                        'table-td-status' => [
                            'template' => 'application/block/table/td-labeled',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'textValueMap' => TestRunStatuses::getAll(),
                                    'colorValueMap' => [
                                        TestRunStatuses::UNTESTED => 'default',
                                        TestRunStatuses::PASSED => 'success',
                                        TestRunStatuses::FAILED => 'danger',
                                        TestRunStatuses::BROKEN => 'warning',
                                        TestRunStatuses::HOSTS_BUILDING => 'info',
                                        TestRunStatuses::TEST_RUNNING => 'info',
                                    ],
                                ],
                                'fromParent' => [
                                    'status' => 'value'
                                ],
                            ],
                        ],

                        'table-td-actions' => [
                            'template' => 'application/block/table/td-buttons-vertical',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'id' => 'id',
                                    'status' => 'status',
                                ],
                            ],
                            'children' => [
                                'run-button' => [
                                    'template' => 'application/block/link-button',
                                    'viewModel' => RunButtonViewModel::class,
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'primary',
                                            'icon' => 'fa-play',
                                            'text' => 'Run',
                                            'routeName' => 'TestRun-run',
                                        ],
                                        'fromParent' => [
                                            'id' => 'id',
                                            'status' => 'status',
                                        ],
                                    ],
                                ],
                                'result-button' => [
                                    'template' => 'application/block/link-button',
                                    'viewModel' => EditButtonViewModel::class,
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'info',
                                            'icon' => 'fa-tasks',
                                            'text' => 'Results',
                                            'routeName' => 'TestRun-result',
                                        ],
                                        'fromParent' => [
                                            'id' => 'id'
                                        ],
                                    ],
                                ],
                                'failed-result-button' => [
                                    'template' => 'application/block/link-button',
                                    'viewModel' => FailedResultsButtonViewModel::class,
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'warning',
                                            'icon' => 'fa-bug',
                                            'text' => 'Failed results',
                                            'routeName' => 'TestRun-failed-result',
                                        ],
                                        'fromParent' => [
                                            'id' => 'id',
                                            'status' => 'status',
                                        ],
                                    ],
                                ],
                                'output-button' => [
                                    'template' => 'application/block/link-button',
                                    'viewModel' => EditButtonViewModel::class,
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'default',
                                            'icon' => 'fa-terminal',
                                            'text' => 'Output',
                                            'routeName' => 'TestRun-output',
                                        ],
                                        'fromParent' => [
                                            'id' => 'id',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'childrenDynamicLists' => [
                'table-body-row' => 'rowsData',
            ],
            'data' => [
                'fromGlobal' => [
                    'result' => 'rowsData',
                ],
            ],
        ],
        'paginator' => [
            'extend' => 'admin-paginator',
            'viewModel' => 'TestRun\ViewModel\PaginatorViewModel',
            'data' => [
                'fromGlobal' => 'validCriteria'
            ],
        ],
    ],
];