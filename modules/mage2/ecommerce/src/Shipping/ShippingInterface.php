<?php

namespace Mage2\Ecommerce\Shipping;

interface ShippingInterface
{
    public function getIdentifier();

    public function getTitle();

    public function getAmount();
}
