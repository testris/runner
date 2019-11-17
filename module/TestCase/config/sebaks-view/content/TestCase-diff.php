<?php

namespace TestCase;

use Application\ViewModel\TableRowViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'application/content/list',
    'data' => [
        'static' => [
            'title' => 'Test Cases diff',
            'icon' => 'fa-code',
        ],
    ],
    'children' => [
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

                        'table-th-environment' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Tests without case',
                                    'width' => '65%',
                                ],
                            ],
                        ],

                        'table-th-started' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Created',
                                    'width' => '10%',
                                ],
                            ],
                        ],

                        'table-th-executed' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Updated',
                                    'width' => '10%',
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

                        'table-td-branch' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'branch' => 'value'
                                ],
                            ],
                        ],
                        'table-td-diff' => [
                            'template' => 'application/block/table/td',
                            'viewModel' => ViewModel\TestsWithoutCaseViewModel::class,
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'existingClasses' => 'value'
                                ],
                            ],
                        ],
                        'table-td-created' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['created' => 'value'],
                            ],
                        ],
                        'table-td-updated' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['updated' => 'value'],
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