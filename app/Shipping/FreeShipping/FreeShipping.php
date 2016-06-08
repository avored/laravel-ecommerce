<?php
namespace App\Shipping\FreeShipping;

class FreeShipping {
    
    public $identifier = "free_shipping";
    public $label = "free_shipping";
    
    
    
    public function isEnable() {
        //@todo use system config
        return true;
    }
    public function getIdentifier() {
        return $this->identifier;
    }
    
    public function getLabel() {
        return $this->label;
    }
    
}
