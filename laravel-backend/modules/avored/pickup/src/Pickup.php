<?php
namespace AvoRed\Pickup;

class Pickup
{

    const CONFIG_KEY = 'shipping_pickup_enabled';

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
    protected $name = 'Pickup from Store';

    /**
     * Payment options View Path.
     *
     * @var string
     */
    protected $view = 'avored-pickup::pickup';

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
