<?php
namespace KmbDashboardTest\View\Decorator;

use KmbDashboard\View\Decorator\OsDistributionDecorator;
use KmbDashboardTest\Bootstrap;

class OsDistributionDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function canDecorate()
    {
        $decorator = new OsDistributionDecorator();
        $decorator->setViewHelperManager(Bootstrap::getServiceManager()->get('ViewHelperManager'));

        $result = $decorator->decorate([
            'nodesCountByOS' => [
                'Debian GNU/Linux 6.0.7 (squeeze)' => 29,
                'windows' => 20,
                'Debian GNU/Linux 7.4 (wheezy)' => 1,
            ],
            'nodesPercentageByOS' => [
                'Debian GNU/Linux 6.0.7 (squeeze)' => 0.58,
                'windows' => 0.40,
                'Debian GNU/Linux 7.4 (wheezy)' => 0.02,
            ]
        ]);

        $this->assertEquals([
            '<div class="row"><div class="col-lg-4"><span class="label label-info label-uniform">29</span> <label>## Debian GNU/Linux 6.0.7 (squeeze) ##</label></div><div class="col-lg-8"><div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100" style="width: 58%"><span>58%</span></div></div></div></div>',
            '<div class="row"><div class="col-lg-4"><span class="label label-info label-uniform">20</span> <label>## windows ##</label></div><div class="col-lg-8"><div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span>40%</span></div></div></div></div>',
            '<div class="row"><div class="col-lg-4"><span class="label label-info label-uniform">1</span> <label>## Debian GNU/Linux 7.4 (wheezy) ##</label></div><div class="col-lg-8"><div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%"></div><span>2%</span></div></div></div>',
        ], $result);
    }
}
