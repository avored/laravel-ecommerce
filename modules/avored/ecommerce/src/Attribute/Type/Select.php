<?php
namespace AvoRed\Ecommerce\Attribute\Type;

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
        return view('avored-ecommerce::product-attribute.select')->with('field', $this);
    }

    public function __toString() {
        return $this->render();
    }
}