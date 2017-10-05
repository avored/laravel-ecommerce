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
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Attribute;

use Illuminate\Support\Collection as LaravelCollection;
use Mage2\Ecommerce\Attribute\Type\Select;

class Collection {

    public $attributes = NULL;


    public function __construct() {
        $this->attributes = LaravelCollection::make([]);
    }

    public function type($type) {
        return $this;

    }
    public function add($key) {
        $this->attributes->put($key, []);

        return $this;
    }


    public function select($type) {
        $select = new Select();
        $select->type($type);
        $this->attributes->push($select);

        return $select;
    }
    public function all($type) {

        $attributes = $this->attributes->filter(function ($item, $key) use ($type) {

            if($item->get('type') == $type) {
                return true;
            }
        });

        return $attributes;
    }
}