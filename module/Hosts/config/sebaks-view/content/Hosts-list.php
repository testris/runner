<?php

namespace Hosts;

use Application\ViewModel\TableRowViewModel;
use Hosts\Entity\Environment;

return [
    'layout' => 'admin-layout',
    'template' => 'application/content/list',
    'data' => [
        'static' => [
            'title' => 'Host',
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
                            'text' => 'Add host',
                            'routeName' => 'Hosts-new',
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

                        'table-th-branch' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Branch',
                                    'width' => '6%',
                                ],
                            ],
                        ],
                        'table-th-site' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Site',
                                    'width' => '50%',
                                ],
                            ],
                        ],

                        'table-th-creator' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Creator',
                                    'width' => '10%',
                                ],
                            ],
                        ],
                        'table-th-environment' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Env',
                                    'width' => '3%',
                                ],
                            ],
                        ],

                        'table-th-created' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Created',
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
                                'fromParent' => ['branch' => 'value',],
                            ],
                        ],
                        'table-td-site' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['site' => 'value'],
                            ],
                        ],
                        'table-td-creator' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['creator' => 'value'],
                            ],
                        ],
                        'table-td-environment' => [
                            'template' => 'application/block/table/td-labeled',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'align' => 'center',
                                    'colorValueMap' => [
                                        1 => 'success',
                                        2 => 'primary',
                                    ],
                                    'textValueMap' => Environment::getAll(),
                                ],
                                'fromParent' => ['environment' => 'value'],
                            ],
                        ],
                        'table-td-created' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['created' => 'value'],
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
            'viewModel' => 'Hosts\ViewModel\PaginatorViewModel',
            'data' => [
                'fromGlobal' => 'validCriteria'
            ],
        ],
    ],
];