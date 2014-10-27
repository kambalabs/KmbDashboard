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
use KmbPuppetDb\Query\QueryBuilderInterface;
use KmbPuppetDb\Service\NodeStatisticsInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /** @var EnvironmentInterface $environment */
        $environment = $this->serviceLocator->get('EnvironmentRepository')->getById($this->params()->fromRoute('envId'));
        $this->serviceLocator->get('KmbPermission\Service\Environment')->getAllReadable($environment);

        return new ViewModel(['environment' => $environment]);
    }

    public function statsAction()
    {
        /** @var EnvironmentInterface $environment */
        $environment = $this->serviceLocator->get('EnvironmentRepository')->getById($this->params()->fromRoute('envId'));

        /** @var QueryBuilderInterface $nodesEnvironmentsQueryBuilder */
        $nodesEnvironmentsQueryBuilder = $this->serviceLocator->get('KmbPuppetDb\Query\NodesEnvironmentsQueryBuilder');

        /** @var \KmbPermission\Service\EnvironmentInterface $permissionEnvironmentService */
        $permissionEnvironmentService = $this->serviceLocator->get('KmbPermission\Service\Environment');
        $environments = $permissionEnvironmentService->getAllReadable($environment);

        /** @var NodeStatisticsInterface $nodeStatistics */
        $nodeStatistics = $this->serviceLocator->get('nodeStatisticsService');

        $statistics = $nodeStatistics->getAllAsArray($nodesEnvironmentsQueryBuilder->build($environments));

        return new JsonModel([
            'changedCount' => $this->decorateChangedCount($statistics),
            'failedCount' => $this->decorateFailedCount($statistics),
            'unchangedCount' => $this->decorateUnchangedCount($statistics),
            'osDistribution' => $this->decorateOsDistribution($statistics),
            'osDistributionTitle' => $this->decorateOsDistributionTitle($statistics),
            'recentlyRebooted' => $this->decorateRecentlyRebooted($statistics),
        ]);
    }
}
