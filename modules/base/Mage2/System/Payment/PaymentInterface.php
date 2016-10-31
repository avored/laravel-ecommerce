<?php

namespace Mage2\System\Payment;

interface PaymentInterface
{
    public function getIdentifier();

    public function getTitle();
}
