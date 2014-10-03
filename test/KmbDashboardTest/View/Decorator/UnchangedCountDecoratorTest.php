<?php
namespace KmbDashboardTest\View\Decorator;

use KmbDashboard\View\Decorator\UnchangedCountDecorator;
use KmbDashboardTest\Bootstrap;

class UnchangedCountDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function canDecorate()
    {
        $decorator = new UnchangedCountDecorator();
        $decorator->setViewHelperManager(Bootstrap::getServiceManager()->get('ViewHelperManager'));

        $result = $decorator->decorate(['unchangedCount' => 3]);

        $this->assertEquals('<span class="label label-success label-uniform">3</span> __ Unchanged server __', $result);
    }
}
