<?php
namespace App\Payment\ChequePayment;

class Cheque {
    
    public $identifier = "cheque";
    public $label = "Pay By Cheque";
    
    
    
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
