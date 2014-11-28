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

class OsDistributionDecorator extends AbstractDecorator
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function decorate($data)
    {
        $result = [];
        if (!empty($data['nodesCountByOS'])) {
            foreach ($data['nodesCountByOS'] as $os => $nodesCount) {
                $nodesPercentageByOS = $data['nodesPercentageByOS'][$os];
                $content  = '<div class="row"><div class="col-lg-4"><span class="label label-info label-uniform">' . $this->numberFormat($nodesCount) . '</span> <label>' . $this->escapeHtml($os) . '</label></div><div class="col-lg-8"><div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="' . $nodesPercentageByOS * 100 . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $nodesPercentageByOS * 100 . '%">';
                if ($nodesPercentageByOS < 0.06) {
                    $content .= '</div>';
                }
                $content .= '<span>' . $this->numberFormat($nodesPercentageByOS, \NumberFormatter::PERCENT) . '</span>';
                if ($nodesPercentageByOS >= 0.06) {
                    $content .= '</div>';
                }
                $content .= '</div></div></div>';
                $result[] = $content;
            }
        }
        return $result;
    }
}
