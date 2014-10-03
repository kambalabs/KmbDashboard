<?php
namespace KmbDashboardTest\View\Decorator;

use KmbDashboard\View\Decorator\ChangedCountDecorator;
use KmbDashboardTest\Bootstrap;

class ChangedCountDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function canDecorate()
    {
        $decorator = new ChangedCountDecorator();
        $decorator->setViewHelperManager(Bootstrap::getServiceManager()->get('ViewHelperManager'));

        $result = $decorator->decorate(['changedCount' => 3]);

        $this->assertEquals('<span class="label label-warning label-uniform">3</span> __ Changed server __', $result);
    }
}
