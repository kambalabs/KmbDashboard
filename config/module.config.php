<?php
// Awfull hack to tell to poedit to translate navigation labels
$translate = function($message) { return $message; };
return [
    'router' => [
        'routes' => [
            'index' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId][/]',
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
                    'route' => '[/env/:envId]/dashboard[/[:action]]',
                    'constraints' => [
                        'envId' => '[0-9]+',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => 'KmbDashboard\Controller\Index',
                        'action' => 'index',
                        'envId' => '0',
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
    'controller_plugins' => array(
        'invokables' => array(
            'decorateChangedCount' => 'KmbDashboard\Controller\Plugin\DecorateChangedCount',
            'decorateFailedCount' => 'KmbDashboard\Controller\Plugin\DecorateFailedCount',
            'decorateUnchangedCount' => 'KmbDashboard\Controller\Plugin\DecorateUnchangedCount',
            'decorateOsDistribution' => 'KmbDashboard\Controller\Plugin\DecorateOsDistribution',
            'decorateOsDistributionTitle' => 'KmbDashboard\Controller\Plugin\DecorateOsDistributionTitle',
            'decorateRecentlyRebooted' => 'KmbDashboard\Controller\Plugin\DecorateRecentlyRebooted',
        )
    ),
    'navigation' => [
        'default' => [
            [
                'label' => $translate('Dashboard'),
                'route' => 'index',
                'useRouteMatch' => true,
                'tabindex' => 20,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'zfc_rbac' => [
        'guards' => [
            'ZfcRbac\Guard\ControllerGuard' => [
                [
                    'controller' => 'KmbDashboard\Controller\Index',
                    'actions' => ['index', 'stats'],
                    'roles' => ['user']
                ]
            ]
        ],
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
    ],
];
