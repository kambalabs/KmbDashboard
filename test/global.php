<?php
return [
    'router' => [
        'routes' => [
            'puppet' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/puppet',
                    'defaults' => [
                        '__NAMESPACE__' => 'KmbPuppet\Controller',
                        'controller' => 'Reports',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                    'withid' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:controller[/:id][/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                ],
            ],
            'servers' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/servers[/]',
                    'defaults' => [
                        'controller' => 'KmbServers\Controller\Index',
                        'action' => 'index',
                    ],
                ],
            ],
            'server' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/servers/:hostname[/:action]',
                    'constraints' => [
                        'hostname' => '(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])',
                    ],
                    'defaults' => [
                        'controller' => 'KmbServers\Controller\Index',
                        'action' => 'show',
                    ],
                ],
            ],
        ],
    ],
];
