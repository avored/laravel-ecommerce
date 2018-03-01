<?php

namespace Mage2\Ecommerce\Payment\Pickup;

use Mage2\Ecommerce\Payment\Payment as AbstractPayment;
use Mage2\Ecommerce\Payment\Contracts\Payment as PaymentContract;

class Payment extends AbstractPayment implements PaymentContract
{

    /**
     * Identifier for this Payment options
     *
     * @var string
     *
     */
    protected $identifier;

    /**
     * Title for this Payment options
     *
     * @var string
     *
     */
    protected $name;

    /**
     * Payment options View Path
     *
     * @var string
     *
     */
    protected $view = "mage2-ecommerce::payment.pickup.index";

    /**
     * Identifier for this Payment options
     *
     * return @void
     *
     */
    public function __construct()
    {
        $this->identifier = 'pickup';
        $this->name = 'Pickup From Store';
    }

    /**
     * Get Identifier for this Payment options
     *
     * return string
     *
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Is this Payment Option Enabled?
     *
     * return boolean
     *
     */
    public function isEnabled()
    {
        return true;
    }


    /**
     * Get Title for this Payment Option
     *
     * return boolean
     *
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Payment Option View Path
     *
     * return String
     *
     */
    public function view()
    {
        return $this->view;
    }

    /**
     * Payment Option View Data
     *
     * return Array
     *
     */
    public function with()
    {
        return [];
    }

    /*
     * Process Payment Calculation
     *
     */
    public function process($orderData, $cartProducts, $request)
    {
        //EXECUTE API here if any??

        return true;

    }
}