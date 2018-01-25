<?php
namespace Mage2\Ecommerce\Shipping;

use Illuminate\Support\Collection;

class Manager
{
    /**
     *
     * @var \Illuminate\Support\Collection
     */
    public $shippingOptions;

    public function __construct()
    {
        $this->shippingOption = Collection::make([]);
    }

    public function all()
    {
        return $this->shippingOption;
    }

    public function get($identifier)
    {
        return $this->shippingOption->get($identifier);
    }

    public function put($identifier, $class)
    {
        $this->shippingOption->put($identifier, $class);

        return $this;
    }
}
