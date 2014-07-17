<?php
namespace KmbDashboardTest;

use KmbCoreTest\AbstractBootstrap;
use Zend\Stdlib\ArrayUtils;

define('BASE_PATH', dirname(dirname(__DIR__)));
$kmbCoreModulePath = BASE_PATH . '/vendor/kambalabs/kmb-core';
if (!is_dir($kmbCoreModulePath)) {
    $kmbCoreModulePath = dirname(BASE_PATH) . '/KmbCore';
}
require $kmbCoreModulePath . '/test/KmbCoreTest/AbstractBootstrap.php';

class Bootstrap extends AbstractBootstrap
{
    /**
     * Get the root path of the module.
     * Usually : dirname(dirname(__DIR__))
     *
     * @return string
     */
    public static function rootPath()
    {
        return BASE_PATH;
    }

    public static function getApplicationConfig()
    {
        return ArrayUtils::merge(
            parent::getApplicationConfig(),
            array(
                'modules' => array(
                    'ZfcRbac',
                    'KmbAuthentication',
                    'KmbFakeAuthentication',
                    'KmbPermission',
                    'KmbPuppetDb',
                    'KmbServers',
                    'KmbPuppet',
                    'KmbDashboard',
                )
            )
        );
    }
}

Bootstrap::init();
Bootstrap::chroot();
