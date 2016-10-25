<?php

namespace Mage2\Paypal\Models;

use Illuminate\Database\Eloquent\Model;

class PaypalRecord extends Model
{
    protected $fillable = ['paymentId', 'token', 'PayerID'];
}
