<?php
return [
    'router' => [
        'routes' => [
            'index' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/',
                    'constraints' => [
                        'envId' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'KmbDashboard\Controller\Index',
                        'action' => 'index',
                        'envId' => '0',
                    ],
                ],
            ],
            'dashboard' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/dashboard[/]',
                    'constraints' => [
                        'envId' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'KmbDashboard\Controller\Index',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'KmbDashboard\Controller\Index' => 'KmbDashboard\Controller\IndexController'
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'kmb-dashboard/index/index' => __DIR__ . '/../view/kmb-dashboard/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'zfc_rbac' => [
        'guards' => [
            'ZfcRbac\Guard\ControllerGuard' => [
                [
                    'controller' => 'KmbDashboard\Controller\Index',
                    'actions' => ['index'],
                    'roles' => ['user']
                ]
            ]
        ],
    ],
];
