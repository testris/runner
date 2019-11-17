<?php

use Application\ViewModel\TableRowViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'application/content/list',
    'data' => [
        'static' => [
            'title' => 'Workers',
            'icon' => 'fa-server',
        ],
    ],
    'children' => [
        'page-toolbar' => [
            'template' => 'application/block/page-toolbar',
            'capture' => 'pageToolbar',
            'children' => [
                'button-refresh' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-refresh',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-refresh',
                            'color' => 'info',
                            'text' => 'Refresh',
                            'routeName' => 'Workers-refresh',
                        ],
                    ],
                ],
                'button-update-code' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-update-code',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-download',
                            'color' => 'success',
                            'text' => 'Update code',
                            'routeName' => 'Workers-update-code',
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
                        'table-th-status' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Status',
                                    'width' => '5%',
                                ],
                            ],
                        ],

                        'table-th-ip' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'IP',
                                    'width' => '70%',
                                ],
                            ],
                        ],

                        'table-th-health-check' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Health check',
                                    'width' => '15%',
                                ],
                            ],
                        ],

                        'table-th-actions' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Actions',
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
                        'table-td-status' => [
                            'template' => 'workers/block/table/td-status',
                            'viewModel' => TableRowViewModel::class,
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['healthCheckDate' => 'value'],
                            ],
                        ],

                        'table-td-ip' => [
                            'template' => 'workers/block/table/td-worker',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'ip' => 'ip',
                                    'lastCommand' => 'lastCommand',
                                    'lastResponse' => 'lastResponse',
                                ],
                            ],
                        ],

                        'table-td-health-check' => [
                            'template' => 'workers/block/table/td-time',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['healthCheckDate' => 'value'],
                            ],
                        ],
                        'table-td-actions' => [
                            'template' => 'application/block/table/td-buttons-vertical',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => 'id',
                            ],
                            'children' => [

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
    ],
];