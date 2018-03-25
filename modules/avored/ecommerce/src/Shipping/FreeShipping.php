<?php

namespace AvoRed\Ecommerce\Shipping;

use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Shipping\Shipping as AbstractShipping;
use AvoRed\Framework\Shipping\Contracts\Shipping as ShippingContract;

class FreeShipping extends AbstractShipping implements ShippingContract
{
    /**
     * Identifier for the Shipping Options.
     * @var string
     */
    protected $identifier = 'freeshipping';

    /**
     * Name for the Shipping Options.
     * @var string
     */
    protected $name = 'Free Shipping';

    /**
     * To check if Shipping Option is Enable.
     * @var string
     */
    protected $enable = true;

    /**
     * Amount for the Shipping Options.
     * @var string
     */
    protected $amount;

    /**
     * Get the identifier.
     *
     * return string $identifier
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * Get the Name of the Shipping Option.
     *
     * return string $title
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get the Name of the Shipping Option.
     *
     * return string $title
     */
    public function enable()
    {
        //@todo add Admin Configuration and return value based on it.
        return $this->enable;
    }

    /**
     * Calculate and Return the Amount.
     *
     * return float $amount
     */
    public function amount()
    {
        $orderData = Session::get('order_data');
        $cartProducts = Session::get('cart');
        $this->process($orderData, $cartProducts);

        return $this->amount;
    }

    /**
     * Processing Amount for this Shipping Option.
     *
     * return float $amount
     */
    public function process($orderData, $cartProducts)
    {
        //execute the shipping api here
        $this->amount = 0.00;

        return $this;
    }
}
