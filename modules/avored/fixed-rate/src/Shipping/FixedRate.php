<?php

namespace AvoRed\FixedRate\Shipping;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Shipping\Shipping as AbstractShipping;
use AvoRed\Framework\Shipping\Contracts\Shipping as ShippingContract;

class FixedRate extends AbstractShipping implements ShippingContract
{
    const CONFIX_FIXED_RATE_COST = 'shipping_fixed_rate_cost';

    const CONFIG_KEY = 'shipping_fixed_rate_shipping_enabled';

    /**
     * Identifier for the Shipping Options.
     * @var string
     */
    protected $identifier = 'fixed-rate-shipping';

    /**
     * Name for the Shipping Options.
     * @var string
     */
    protected $name = 'Fixed Rate Shipping';

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
    protected $view = 'avored-fixed-rate::fixed-rate';

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
        $this->enable = Configuration::getConfiguration(self::CONFIG_KEY);

        return $this->enable;
    }

    /**
     * Calculate and Return the Amount.
     *
     * return float $amount
     */
    public function amount()
    {
        $this->amount = Configuration::getConfiguration(self::CONFIX_FIXED_RATE_COST);
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
        $this->amount = Configuration::getConfiguration(self::CONFIX_FIXED_RATE_COST);

        return $this;
    }

    /**
     * Processing Amount for this Shipping Option.
     *
     * @param $orderFormData
     * @return self
     */
    public function calculate($orderFormData)
    {
        $view = view($this->view)->with('shippingOption', $this);

        return $view->render();
    }
}
