<?php

namespace Mage2\Paypal\Models;

use Mage2\Framework\System\Models\BaseModel;

class PaypalRecord extends BaseModel
{
    protected $fillable = ['paymentId', 'token', 'PayerID'];
}
