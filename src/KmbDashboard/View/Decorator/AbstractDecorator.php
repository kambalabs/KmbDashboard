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
namespace KmbDashboard\View\Decorator;

use Zend\View\HelperPluginManager;

abstract class AbstractDecorator
{
    /** @var HelperPluginManager */
    protected $viewHelperManager;

    /**
     * @param mixed $data
     * @return mixed
     */
    abstract public function decorate($data);

    /**
     * Get ViewHelperManager.
     *
     * @return HelperPluginManager
     */
    public function getViewHelperManager()
    {
        return $this->viewHelperManager;
    }

    /**
     * Set ViewHelperManager.
     *
     * @param HelperPluginManager $viewHelperManager
     * @return AbstractDecorator
     */
    public function setViewHelperManager($viewHelperManager)
    {
        $this->viewHelperManager = $viewHelperManager;
        return $this;
    }

    /**
     * @param       $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments = array())
    {
        $plugin = $this->getViewHelperManager()->get($name);
        if (is_callable($plugin)) {
            return call_user_func_array($plugin, $arguments);
        }

        return $plugin;
    }
}
