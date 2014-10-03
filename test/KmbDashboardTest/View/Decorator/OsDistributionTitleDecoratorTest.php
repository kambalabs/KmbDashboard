<?php
namespace KmbDashboardTest\View\Decorator;

use KmbDashboard\View\Decorator\OsDistributionTitleDecorator;
use KmbDashboardTest\Bootstrap;

class OsDistributionTitleDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function canDecorate()
    {
        $decorator = new OsDistributionTitleDecorator();
        $decorator->setViewHelperManager(Bootstrap::getServiceManager()->get('ViewHelperManager'));

        $result = $decorator->decorate(['nodesCount' => 3, 'osCount' => 2]);

        $this->assertEquals('__ <span class="label label-info label-uniform">3</span> server for 2 OS __', $result);
    }
}
