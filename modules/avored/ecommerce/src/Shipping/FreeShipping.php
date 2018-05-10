<?php

namespace AvoRed\Ecommerce\Shipping;

use AvoRed\Framework\Models\Database\Configuration;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Shipping\Shipping as AbstractShipping;
use AvoRed\Framework\Shipping\Contracts\Shipping as ShippingContract;

class FreeShipping extends AbstractShipping implements ShippingContract
{

    const CONFIG_KEY = 'shipping_free_shipping_enabled';

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
     * Payment options View Path.
     *
     * @var string
     */
    protected $view = 'avored-ecommerce::shipping.free-shipping';

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
        $configModel = new Configuration();
        $this->enable = $configModel->getConfiguration(self::CONFIG_KEY);

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
     * Payment Option View Path.
     *
     * return String
     */
    public function view()
    {
        return $this->view;
    }

    /**
     * Payment Option View Data.
     *
     * return Array
     */
    public function with()
    {
        return [];
    }


    /**
     * Processing Amount for this Shipping Option.
     *
     * @param \Illuminate\Support\Collection $cartProducts
     * @return self
     */
    public function process($cartProducts)
    {
        //execute the shipping api here
        $this->amount = 0.00;

        return $this;
    }
}
