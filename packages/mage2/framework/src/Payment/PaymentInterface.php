<?php

namespace Mage2\Framework\Payment;

interface PaymentInterface
{
    public function getIdentifier();

    public function getTitle();

    public function isEnabled();
}
