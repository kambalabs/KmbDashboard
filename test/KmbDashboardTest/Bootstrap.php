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

    public static function getNamespacePaths()
    {
        return ArrayUtils::merge(parent::getNamespacePaths(), [
            __NAMESPACE__ => __DIR__
        ]);
    }

    public static function getApplicationConfig()
    {
        return ArrayUtils::merge(
            parent::getApplicationConfig(),
            array(
                'module_listener_options' => array(
                    'config_glob_paths' => array(
                        dirname(__DIR__) . '/{,*.}{global,local}.php',
                    ),
                ),
                'modules' => array(
                    'ZfcRbac',
                    'KmbDomain',
                    'KmbMemoryInfrastructure',
                    'KmbAuthentication',
                    'KmbFakeAuthentication',
                    'KmbPermission',
                    'KmbPuppetDb',
                    'KmbDashboard',
                )
            )
        );
    }
}

Bootstrap::init();
Bootstrap::chroot();
