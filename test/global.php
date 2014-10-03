<?php
return [
    'router' => [
        'routes' => [
            'servers' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/servers[/[:action]]',
                    'defaults' => [
                    ],
                ],
            ],
            'server' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/server/:hostname[/[:action]]',
                    'defaults' => [
                    ],
                ],
            ],
            'puppet' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/puppet[/[:controller[/:action]]]',
                    'defaults' => [
                    ],
                ],
            ],
            'puppet-environment' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/puppet/environment/:id/:action',
                    'defaults' => [
                    ],
                ],
            ],
            'puppet-environment-user-remove' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/env/:envId]/puppet/environment/:id/user/:userId/remove',
                    'defaults' => [
                    ],
                ],
            ],
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'translate' => 'KmbBaseTest\View\Helper\FakeTranslateHelper',
            'translatePlural' => 'KmbBaseTest\View\Helper\FakeTranslateHelper',
            'escapeHtml' => 'KmbBaseTest\View\Helper\FakeEscapeHtmlHelper',
            'escapeHtmlAttr' => 'KmbBaseTest\View\Helper\FakeEscapeHtmlAttrHelper',
            'url' => 'KmbBaseTest\View\Helper\FakeUrlHelper',
        ],
    ],
];
