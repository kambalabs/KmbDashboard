<?php
/**
 * @copyright Copyright (c) 2014 Orange Applications for Business
 * @link      http://github.com/kambalabs for the sources repositories
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
namespace KmbDashboard\Controller\Plugin;

use KmbDashboard\View\Decorator\OsDistributionDecorator;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\HelperPluginManager;

class DecorateOsDistribution extends AbstractPlugin
{
    public function __invoke($data)
    {
        /** @var HelperPluginManager $viewHelperManager */
        $viewHelperManager = $this->controller->getServiceLocator()->get('ViewHelperManager');

        $decorator = new OsDistributionDecorator();
        $decorator->setViewHelperManager($viewHelperManager);

        return $decorator->decorate($data);
    }
}
