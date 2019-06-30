<?php
namespace AvoRed\CashOnDelivery;

class CashOnDelivery
{
    
    const CONFIG_KEY = 'payment_cash_on_delivery_enabled';
    
    /**
     * Identifier for this Payment options.
     *
     * @var string
     */
    protected $identifier = 'cash-on-delivery';
    
    /**
     * Title for this Payment options.
     *
     * @var string
     */
    protected $name = 'Cash On Delivery';
    
    /**
     * Payment options View Path.
     *
     * @var string
     */
    protected $view = 'avored-cash-on-delivery::cash-on-delivery';
    
    /**
     * Get Identifier for this Payment options.
     *
     * return string
     */
    public function identifier()
    {
        return $this->identifier;
    }
    
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
}
