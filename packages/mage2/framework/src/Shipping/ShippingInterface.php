<?php

namespace Mage2\Framework\Shipping;

interface ShippingInterface
{
    public function getIdentifier();

    public function getTitle();

    public function getAmount();
}
