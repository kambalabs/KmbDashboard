<?php
namespace KmbDashboardTest;

use KmbBaseTest\AbstractBootstrap;
use Zend\Stdlib\ArrayUtils;

define('BASE_PATH', dirname(dirname(__DIR__)));
$kmbBaseModulePath = BASE_PATH . '/vendor/kambalabs/kmb-base';
if (!is_dir($kmbBaseModulePath)) {
    $kmbBaseModulePath = dirname(BASE_PATH) . '/KmbBase';
}
require $kmbBaseModulePath . '/test/KmbBaseTest/AbstractBootstrap.php';

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
