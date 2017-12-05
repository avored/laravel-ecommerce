<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\DataGrid\Columns;

use Mage2\Ecommerce\DataGrid\Contracts\Column as ColumnContract;

abstract class AbstractColumn  implements  ColumnContract {

    /**
     * Column Identifier
     * @var null|string $identifier
     */
    protected $identifier = NULL;

    /**
     * Column Label
     * @var null|string $label
     */
    protected $label = NULL;

    /**
     * Is Column Sortable?
     * @var null|string $sortable
     */
    protected $sortable = NULL;


    /**
     *
     *
     * @param string $identifier
     * @param array $options
     */
    public function __construct($identifier, $options) {

        $this->identifier = $identifier;
        $this->label = (isset($options['label'])) ? $options['label'] : title_case($identifier);
        $this->sortable = (isset($options['sortable'])) ? $options['sortable'] : false;
    }

    /**
     * Get the Column Type
     * @return string $type
     */
    public function sortable() {
        return $this->sortable;
    }

    /**
     * Get the Column Type
     * @return string $type
     */
    public function type() {
        return $this->type;
    }

    /**
     * Get the Column Label
     * @return string $label
     */
    public function label() {
        return $this->label;
    }

    /**
     * Get the column identifier.
     * @return string $identifier
     */
    public function identifier() {
        return $this->identifier;
    }
}