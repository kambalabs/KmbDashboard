<?php
return [
    'router' => [
        'routes' => [
            'index' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'KmbDashboard\Controller\Index',
                        'action' => 'index',
                    ],
                ],
            ],
            'dashboard' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
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
