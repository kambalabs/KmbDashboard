<?php
namespace KmbDashboardTest\Controller;

use KmbDashboardTest\Bootstrap;
use KmbMemoryInfrastructure\Fixtures;
use Zend\Json\Json;
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
        $this->dispatch('/dashboard');

        $this->assertResponseStatusCode(200);
        $this->assertControllerName('KmbDashboard\Controller\Index');
        $this->assertQueryContentContains('#loading > p', '__ Loading statistics ... __');
    }

    /** @test */
    public function canGetStats()
    {
        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('KmbPuppetDb\Service\NodeStatistics', $this->mockNodeStatistics());

        $this->dispatch('/dashboard/stats');

        $this->assertResponseStatusCode(200);
        $this->assertControllerName('KmbDashboard\Controller\Index');
        $result = Json::decode($this->getResponse()->getContent(), Json::TYPE_ARRAY);
        $this->assertEquals('<span class="label label-danger label-uniform">1</span> __ Failed server __', $result['failedCount']);
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->getApplicationServiceLocator();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockNodeStatistics()
    {
        $nodeStatisticsMock = $this->getMock('KmbPuppetDb\Service\NodeStatisticsInterface');
        $nodeStatisticsMock->expects($this->any())
            ->method('getAllAsArray')
            ->will($this->returnValue([
                'unchangedCount' => 3,
                'changedCount' => 1,
                'failedCount' => 1,
                'nodesCount' => 5,
                'nodesCountByOS' => [
                    'Debian GNU/Linux 6.0.7 (squeeze)' => 2,
                    'windows' => 2,
                    'Debian GNU/Linux 7.4 (wheezy)' => 1,
                ],
                'nodesPercentageByOS' => [
                    'Debian GNU/Linux 6.0.7 (squeeze)' => 0.40,
                    'windows' => 0.40,
                    'Debian GNU/Linux 7.4 (wheezy)' => 0.20,
                ],
                'osCount' => 3,
                'recentlyRebootedNodes' => ['node2.local' => '2:32 hours', 'node4.local' => '4:01 hours'],
            ]));
        return $nodeStatisticsMock;
    }
}
