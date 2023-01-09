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
    protected $identifier = 'a-cash-on-delivery';

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
    protected $view = 'a-cash-on-delivery::index';

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

    public function process()
    {
        //
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
     * return String
     */
    public function view()
    {
        return $this->view;
    }

    /**
     * Render Payment Option
     * return String
     */
    public function render()
    {
        return view($this->view())->with($this->with());
    }


    /**
     * Payment Option View Data.
     *
     * return Array
     */
    public function with()
    {
        return ['payment' => $this];
    }
}
