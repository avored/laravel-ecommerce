<?php
namespace Mage2\Ecommerce\Payment;

class Pickup extends Payment implements PaymentInterface
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
    protected $title;

    /**
     * Identifier for this Payment options
     *
     * return @void
     *
     */
    public function __construct()
    {
        $this->identifier = 'pickup';
        $this->title = 'Pickup From Store';
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
    public function getTitle()
    {
        return $this->title;
    }

    /*
     * Process Payment Calculation
     *
     */
    public function process($orderData, $cartProducts)
    {
        //EXECUTE API here if any??

    }
}
