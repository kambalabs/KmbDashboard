<?php
/**
 * @copyright Copyright (c) 2014 Orange Applications for Business
 * @link      http://github.com/multimediabs/Kamba for the canonical source repository
 *
 * This file is part of Kamba.
 *
 * Kamba is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Kamba is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Kamba.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace KmbDashboard\Controller;

use KmbDomain\Model\EnvironmentInterface;
use KmbPuppetDb\Query\EnvironmentsQueryBuilderInterface;
use KmbPuppetDb\Service\NodeStatisticsInterface;
use KmbPuppetDb\Service\ReportStatisticsInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $serviceManager = $this->getServiceLocator();

        /** @var NodeStatisticsInterface $nodeStatistics */
        $nodeStatistics = $serviceManager->get('nodeStatisticsService');
        /** @var ReportStatisticsInterface $reportStatistics */
        $reportStatistics = $serviceManager->get('reportStatisticsService');
        /** @var EnvironmentsQueryBuilderInterface $nodesEnvironmentsQueryBuilder */
        $nodesEnvironmentsQueryBuilder = $serviceManager->get('KmbPuppetDb\Query\NodesEnvironmentsQueryBuilder');
        /** @var EnvironmentsQueryBuilderInterface $reportsEnvironmentsQueryBuilder */
        $reportsEnvironmentsQueryBuilder = $serviceManager->get('KmbPuppetDb\Query\ReportsEnvironmentsQueryBuilder');
        /** @var \KmbPermission\Service\EnvironmentInterface $permissionEnvironmentService */
        $permissionEnvironmentService = $serviceManager->get('KmbPermission\Service\Environment');

        /** @var EnvironmentInterface $environment */
        $environment = $serviceManager->get('EnvironmentRepository')->getById($this->params()->fromRoute('envId'));
        $environments = $permissionEnvironmentService->getAllReadable($environment);

        $model = array_merge(
            ['environment' => $environment],
            $nodeStatistics->getAllAsArray($nodesEnvironmentsQueryBuilder->build($environments)),
            $reportStatistics->getAllAsArray($reportsEnvironmentsQueryBuilder->build($environments))
        );

        return new ViewModel($model);
    }
}
