<?php

namespace Mage2\Ecommerce\Payment\Pickup;

use Mage2\Ecommerce\Payment\Payment as AbstractPayment;
use Mage2\Ecommerce\Payment\PaymentInterface;

class Payment extends AbstractPayment implements PaymentInterface
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

    /*
     * Process Payment Calculation
     *
     */
    public function process($orderData, $cartProducts, $request)
    {
        //EXECUTE API here if any??

    }
}