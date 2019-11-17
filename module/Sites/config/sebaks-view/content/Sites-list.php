<?php

namespace Sites;

use Application\ViewModel\EditButtonViewModel;
use Application\ViewModel\TableRowViewModel;
use Sites\ViewModel\TypesViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'application/content/list',
    'data' => [
        'static' => [
            'title' => 'Sites',
            'icon' => 'fa-globe',
        ],
    ],
    'children' => [
        'page-toolbar' => [
            'template' => 'application/block/page-toolbar',
            'capture' => 'pageToolbar',
            'children' => [
                'button-new-entity' => [
                    'template' => 'application/block/link-button',
                    'capture' => 'button-new-entity',
                    'data' => [
                        'static' => [
                            'icon' => 'fa-plus',
                            'color' => 'success',
                            'text' => 'Add site',
                            'routeName' => 'Sites-new',
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
                                ],
                            ],
                        ],

                        'table-th-domain' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Domain',
                                    'width' => '45%',
                                ],
                            ],
                        ],

                        'table-th-type' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Type',
                                    'width' => '40%',
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
                        'table-td-id' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['id' => 'value'],
                            ],
                        ],
                        'table-td-domain' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'domain' => 'value'
                                ],
                            ],
                        ],
                        'table-td-type' => [
                            'template' => 'application/block/table/td',
                            'viewModel' => TypesViewModel::class,
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'type' => 'value',
                                ],
                            ],
                        ],
                        'table-td-actions' => [
                            'template' => 'application/block/table/td-buttons-vertical',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => 'id',
                            ],
                            'children' => [
                                'edit-button' => [
                                    'template' => 'application/block/link-button',
                                    'viewModel' => EditButtonViewModel::class,
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'success',
                                            'icon' => 'fa-pencil',
                                            'text' => 'Edit',
                                            'routeName' => 'Sites-read',
                                        ],
                                        'fromParent' => 'id',
                                    ],
                                ],
                                'delete-button' => [
                                    'template' => 'application/block/link-button-with-confirm',
                                    'viewModel' => EditButtonViewModel::class,
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'danger',
                                            'icon' => 'fa-times',
                                            'buttonText' => 'Delete',
                                            'modalTitle' => 'Site deleting',
                                            'modalText' => 'Do you really want to delete site?',
                                            'routeName' => 'Sites-delete',
                                            'aclName' => 'mail_manager',
                                            'aclAction' => 'delete',
                                        ],
                                        'fromParent' => 'id',
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
            'viewModel' => 'Site\ViewModel\PaginatorViewModel',
            'data' => [
                'fromGlobal' => 'validCriteria'
            ],
        ],
    ],
];