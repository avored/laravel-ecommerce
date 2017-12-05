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
namespace Mage2\Ecommerce\Attribute\Type;

use Illuminate\Support\Collection;

class Select  extends Collection {


    public function type($type = NULL) {
        if(null === $type) {
            return $this->get('type');
        }

        $this->put('type', $type);

        return $this;
    }

    public function name($name = NULL) {
        if(null === $name) {
            return $this->get('name');
        }

        $this->put('name', $name);

        return $this;
    }

    public function label($label = NULL) {
        if(null === $label) {
            return $this->get('label');
        }

        $this->put('label', $label);

        return $this;
    }

    public function option($options = []) {

        if(count($options) <= 0) {
            return $this->get('options');
        }
        $this->put('options', $options);

        return $this;
    }



    public function render() {
        return view('mage2-ecommerce::product-attribute.select')->with('field', $this);
    }

    public function __toString() {
        return $this->render();
    }
}