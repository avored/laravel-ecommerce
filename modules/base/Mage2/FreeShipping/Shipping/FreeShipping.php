<?php

namespace Mage2\FreeShipping\Shipping;

use Mage2\Framework\Shipping\ShippingInterface;

class FreeShipping implements ShippingInterface {

    protected $identifier;
    protected $title;

    public function __construct() {
        $this->identifier = "freeshipping";
        $this->title = "Free Shipping";
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAmount() {
        return "0.00";
    }

}
