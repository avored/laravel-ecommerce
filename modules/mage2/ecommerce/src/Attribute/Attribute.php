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

use Illuminate\Support\Collection;

class Attribute extends Collection{


    public function type($type = NULL) {
        if(NULL === $type) {
            return $this->get('type');
        }
        $this->put('type', $type);

        return $this;
    }

    public function field($type = 'text', $attributeFieldOptions = []) {
        if(NULL === $type) {
            return $this->get('field');
        }

        $attributeFieldOptions ['type'] = $type;
        $this->put('field', $attributeFieldOptions);

        return $this;
    }


    public function render() {
        $field = $this->get('field');

        $elementString = "<div class='form-group'>";

        if(isset($field['attributes']) && isset($field['attributes']['name'])) {
            $name = $field['attributes']['name'];
        } else {
            throw new \Exception('Field Attribute is not set');
        }

        $label = (isset($field['label'])) ? $field['label'] : title_case($field['attribute']['name']);


        $elementString .= "<label for='{$name}'>{$label}</label>";

        $fieldAttrString = "";
        foreach ($field['attributes'] as $attrKey => $attrVal) {
            $fieldAttrString .= $attrKey . "=" . "$attrVal ";
        }

        $fieldOptionString = "";
        foreach ($field['options'] as $optionKey => $optionVal) {
            $fieldOptionString .=  "<option value=" . $optionKey . ">" . "$optionVal " . "</option> ";
        }

        $elementString .= "<select {$fieldAttrString}>{$fieldOptionString}</select></div>";

        return $elementString;
    }
}