<?php

namespace Mage2\Pickup\Payment;

use Mage2\Framework\Payment\Payment;
use Mage2\Framework\Payment\PaymentInterface;

class Pickup extends Payment implements PaymentInterface
{
    protected $identifier;
    protected $title;

    public function __construct()
    {
        $this->identifier = 'pickup';
        $this->title = 'Pickup From Store';
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function isEnabled()
    {
        return true;
    }


    public function getTitle()
    {
        return $this->title;
    }

    /*
     * Nothing to do
     *
     */
    public function process($orderData, $cartProducts)
    {
        
    }
}
