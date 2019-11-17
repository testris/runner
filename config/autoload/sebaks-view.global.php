<?php

return [
    'sebaks-view' => [
        'layouts' => [
            'admin-layout' => [
                'template' => 'layout/layout',
                'children' => [
                    'admin-header-top',
                    'admin-header-menu',
                ],
            ],
            'empty-layout' => [
                'template' => 'layout/empty',
            ],
            'api-docs' => [
                'template' => 'layout/api-docs',
            ],
        ],
        'contents' => [
            'admin-list' => [
                'layout' => 'admin-layout',
                'template' => 'application/content/list',
            ],
            'admin-read' => [
                'layout' => 'admin-layout',
                'template' => 'application/content/read',
            ],
        ],
        'blocks' => [
            'admin-header-menu' => [
                'capture' => 'headerMenu',
                'template' => 'application/block/header-menu',
            ],
            'admin-sidebar-menu-item' => [
                'capture' => 'item',
                'viewModel' => 'admin-viewmodel-sidebar-menu-item',
                'template' => 'application/block/sidebar-menu-item',
            ],
            'admin-sidebar-treeview-menu-item' => [
                'capture' => 'treeview-item',
                'viewModel' => 'admin-viewmodel-sidebar-menu-item',
                'template' => 'application/block/sidebar-treeview-menu-item',
            ],
            'admin-header-top' => [
                'capture' => 'headerTop',
                'template' => 'application/block/header-top',
            ],
            'admin-filter' => [
                // 'viewModel' => \AdminV2\Application\ViewModel\FilterFormViewModel::class,
                'template' => 'application/block/filter',
                'data' => [
                    'fromGlobal' => [
                        'validCriteria' => 'validCriteria'
                    ]
                ],
                'children' => [
                    'form-button-submit' => [
                        'template' => 'application/block/submit-button',
                        'capture' => 'form-button',
                        'data' => [
                            'static' => [
                                'color' => 'primary',
                                'text' => 'Filter',
                            ],
                        ],
                    ],
                    'form-button-clear' => [
                        'template' => 'application/block/link-button',
                        'capture' => 'form-button',
                        'data' => [
                            'static' => [
                                'text' => 'Clear',
                            ],
                        ],
                    ],
                ],

            ],
            'admin-form' => [
                'capture' => 'form',
                'template' => 'application/block/form',
                'viewModel' => Application\ViewModel\FormViewModel::class,
                'data' => [
                    'static' => [
                        'method' => 'post',
                    ],
                    'fromGlobal' => [
                        'result' => 'result',
                        'criteria' => 'actionRouteOptions',
                        'changes' => 'changes',
                        'changesErrors' => 'changesErrors',
                    ],
                ],
                'children' => [
                    'form-button-submit' => [
                        'template' => 'application/block/submit-button',
                        'capture' => 'form-button',
                        'data' => [
                            'static' => [
                                'color' => 'primary',
                                'text' => 'Save',
                            ],
                        ],
                    ],
                    'form-button-cancel' => [
                        'template' => 'application/block/link-button',
                        'capture' => 'form-button',
                        'data' => [
                            'static' => [
                                'text' => 'Cancel',
                            ],
                        ],
                    ],
                ],
            ],
            'admin-form-new' => [
                'capture' => 'form',
                'template' => 'application/block/form',
                 'viewModel' => Application\ViewModel\FormNewViewModel::class,
                'data' => [
                    'static' => [
                        'method' => 'post',
                    ],
                    'fromGlobal' => [
                        'result' => 'result',
                        'criteria' => 'actionRouteOptions',
                        'changes' => 'changes',
                        'changesErrors' => 'errors',
                    ],
                ],
                'children' => [
                    'form-button-submit' => [
                        'template' => 'application/block/submit-button',
                        'capture' => 'form-button',
                        'data' => [
                            'static' => [
                                'color' => 'primary',
                                'text' => 'Save',
                            ],
                        ],
                    ],
                    'form-button-cancel' => [
                        'template' => 'application/block/link-button',
                        // 'viewModel' => \AdminV2\Application\ViewModel\CancelButtonViewModel::class,
                        'capture' => 'form-button',
                        'data' => [
                            'static' => [
                                'text' => 'Cancel',
                            ],
                        ],
                    ],
                ],
            ],
            'admin-table' => [
                'capture' => 'table',
                'template' => 'application/block/table',
                 'viewModel' => \Application\ViewModel\TableViewModel::class,
            ],
            'admin-paginator' => [
                'template' => 'application/block/paginator',
                'data' => [
                    'fromGlobal' => 'validCriteria'
                ]
            ],
        ],
    ],
];
