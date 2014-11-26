<?php
return [
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
