<?php
namespace KmbDashboardTest\View\Decorator;

use KmbDashboard\View\Decorator\RecentlyRebootedDecorator;
use KmbDashboardTest\Bootstrap;

class RecentlyRebootedDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function canDecorate()
    {
        $decorator = new RecentlyRebootedDecorator();
        $decorator->setViewHelperManager(Bootstrap::getServiceManager()->get('ViewHelperManager'));

        $result = $decorator->decorate([
            'recentlyRebootedNodes' => ['node2.local' => '2:32 hours', 'node4.local' => '4:01 hours']
        ]);

        $this->assertEquals([
            '<li class="list-group-item"><span class="label label-warning label-uniform-large">## 2:32 hours ##</span>&nbsp;<a href="/servers/.. node2.local ..?back=">## node2.local ##</a></li>',
            '<li class="list-group-item"><span class="label label-warning label-uniform-large">## 4:01 hours ##</span>&nbsp;<a href="/servers/.. node4.local ..?back=">## node4.local ##</a></li>',
        ], $result);
    }
}
