<?php
namespace KmbDashboardTest\View\Decorator;

use KmbDashboard\View\Decorator\FailedCountDecorator;
use KmbDashboardTest\Bootstrap;

class FailedCountDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function canDecorate()
    {
        $decorator = new FailedCountDecorator();
        $decorator->setViewHelperManager(Bootstrap::getServiceManager()->get('ViewHelperManager'));

        $result = $decorator->decorate(['failedCount' => 3]);

        $this->assertEquals('<span class="label label-danger label-uniform">3</span> __ Failed server __', $result);
    }
}
