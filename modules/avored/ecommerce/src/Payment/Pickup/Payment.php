<?php

namespace AvoRed\Ecommerce\Payment\Pickup;

use AvoRed\Framework\Payment\Payment as AbstractPayment;
use AvoRed\Framework\Payment\Contracts\Payment as PaymentContract;

class Payment extends AbstractPayment implements PaymentContract
{
    /**
     * Identifier for this Payment options.
     *
     * @var string
     */
    protected $identifier = 'pickup';

    /**
     * Title for this Payment options.
     *
     * @var string
     */
    protected $name = 'Pickup From Store';

    /**
     * Payment options View Path.
     *
     * @var string
     */
    protected $view = 'avored-ecommerce::payment.pickup.index';

    /**
     * Get Identifier for this Payment options.
     *
     * return string
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * Is this Payment Option Enabled?
     *
     * return boolean
     */
    public function enable()
    {
        return true;
    }

    /**
     * Get Title for this Payment Option.
     *
     * return boolean
     */
    public function name()
    {
        return $this->name;
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
