<?php
namespace KmbDashboardTest\Controller;

use KmbDashboardTest\Bootstrap;
use KmbMemoryInfrastructure\Fixtures;
use Zend\ServiceManager\ServiceManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    use Fixtures;
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(Bootstrap::getApplicationConfig());
        parent::setUp();
        $this->initFixtures();
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

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('KmbPuppetDb\Service\NodeStatistics', $nodeStatisticsMock);

        $this->dispatch('/dashboard');

        $this->assertResponseStatusCode(200);
        $this->assertControllerName('KmbDashboard\Controller\Index');
        $this->assertQueryContentContains('div.panel-heading .label', '433');
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->getApplicationServiceLocator();
    }
}
