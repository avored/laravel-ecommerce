<?php

namespace Mage2\FreeShipping\Shipping;

use Illuminate\Support\Facades\Session;
use Mage2\Framework\System\Shipping\Shipping;
use Mage2\Framework\System\Shipping\ShippingInterface;

class FreeShipping extends Shipping implements ShippingInterface
{
    protected $identifier;
    protected $title;
    protected $amount;

    public function __construct()
    {
        $this->identifier = 'freeshipping';
        $this->title = 'Free Shipping';
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAmount()
    {
        $orderData = Session::get('order_data');
        $cartProducts = Session::get('cart');
        $this->process($orderData, $cartProducts);

        return $this->amount;
    }

    public function process($orderData, $cartProducts)
    {
        //execute the shipping api here
        $this->amount = '0.00';

        return $this;
    }
}
