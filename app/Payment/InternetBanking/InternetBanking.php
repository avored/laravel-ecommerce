<?php
namespace App\Payment\InternetBanking;

class InternetBanking {
    
    public $identifier = "internet_baking";
    public $label = "Internet Banking";
    
    
    
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
