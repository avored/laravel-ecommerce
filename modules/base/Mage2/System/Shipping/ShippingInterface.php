<?php

namespace Mage2\System\Shipping;

interface ShippingInterface
{
    public function getIdentifier();

    public function getTitle();

    public function getAmount();
}
