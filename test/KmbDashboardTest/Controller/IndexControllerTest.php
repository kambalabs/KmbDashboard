<?php
namespace KmbDashboardTest\Controller;

use KmbDashboardTest\Bootstrap;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(Bootstrap::getApplicationConfig());
        parent::setUp();
    }

    /** @test */
    public function canGetIndex()
    {
        $nodeStatisticsMock = $this->getMock('KmbPuppetDb\Service\NodeStatisticsInterface');
        $nodeStatisticsMock->expects($this->any())
            ->method('getAllAsArray')
            ->will($this->returnValue(array(
                'unchangedCount' => 398,
                'changedCount' => 33,
                'failedCount' => 2,
                'nodesCount' => 433,
                'osCount' => 2,
                'nodesCountByOS' => array(
                    'Debian GNU/Linux 7.4 (wheezy)' => 18,
                    'windows' => 2,
                ),
                'nodesPercentageByOS' => array(
                    'Debian GNU/Linux 7.4 (wheezy)' => 90,
                    'windows' => 10,
                ),
                'recentlyRebootedNodes' => array(
                    'node1.local' => '2:03 hours',
                    'node2.local' => '13:29 hours',
                ),
            )));
        $reportStatisticsMock = $this->getMock('KmbPuppetDb\Service\ReportStatisticsInterface');
        $reportStatisticsMock->expects($this->any())
            ->method('getAllAsArray')
            ->will($this->returnValue(array(
                'skips' => 804,
                'success' => 465,
                'failures' => 152,
                'noops' => 16,
            )));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('KmbPuppetDb\Service\NodeStatistics', $nodeStatisticsMock);
        $serviceManager->setService('KmbPuppetDb\Service\ReportStatistics', $reportStatisticsMock);

        $this->dispatch('/dashboard');

        $this->assertResponseStatusCode(200);
        $this->assertControllerName('KmbDashboard\Controller\Index');
        $this->assertQueryContentContains('span.stats_puppet_skips', '804');
        $this->assertQueryContentContains('span.stats_puppet_success', '465');
        $this->assertQueryContentContains('span.stats_puppet_failures', '152');
        $this->assertQueryContentContains('div.panel-heading .label', '433');
    }
}
