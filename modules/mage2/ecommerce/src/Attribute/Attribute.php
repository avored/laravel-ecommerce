<?php
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