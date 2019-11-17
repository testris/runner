<?php

namespace Users;

use Application\ViewModel\EditButtonViewModel;
use Application\ViewModel\TableRowViewModel;

return [
    'layout' => 'admin-layout',
    'template' => 'application/content/list',
    'data' => [
        'static' => [
            'title' => 'Users',
            'icon' => 'fa-users',
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
                            'text' => 'Add user',
                            'routeName' => 'Users-new',
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

                        'table-th-label' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Name',
                                    'width' => '45%',
                                ],
                            ],
                        ],

                        'table-th-email' => [
                            'template' => 'application/block/table/th',
                            'capture' => 'table-td',
                            'data' => [
                                'static' => [
                                    'value' => 'Email',
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

                        'table-td-name' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => [
                                    'name' => 'value'
                                ],
                            ],
                        ],
                        'table-td-email' => [
                            'template' => 'application/block/table/td',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => ['email' => 'value'],
                            ],
                        ],
                        'table-td-actions' => [
                            'template' => 'application/block/table/td-buttons-vertical',
                            'capture' => 'table-td',
                            'data' => [
                                'fromParent' => 'id',
                            ],
                            'children' => [
                                'permissions-view-button' => [
                                    'template' => 'application/block/link-button',
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'info',
                                            'icon' => 'fa-eye',
                                            'text' => 'Permissions',
                                            'routeName' => 'Users-list',
                                            'routeOptions' => [
                                                'query' => [
                                                    'accountId' => 'id',
                                                ],
                                            ],
                                        ],
                                        'fromParent' => 'id',
                                    ],
                                ],
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
                                            'routeName' => 'Users-read',
//                                            'aclName' => 'mail_manager',
//                                            'aclAction' => 'edit',
                                        ],
                                        'fromParent' => 'id',
                                    ],
                                ],
                                'delete-button' => [
                                    'template' => 'application/block/link-button-with-confirm',
                                    'capture' => 'button',
                                    'data' => [
                                        'static' => [
                                            'size' => 'xs',
                                            'color' => 'danger',
                                            'icon' => 'fa-times',
                                            'buttonText' => 'Delete',
                                            'modalTitle' => 'User deleting',
                                            'modalText' => 'Do you really want to delete user?',
                                            'routeName' => 'Users-list',
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
    ],
];