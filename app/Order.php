<?php

namespace App;

use App\Address;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['shipping_address_id','billing_address_id','customer_id','payment_option','shipping_option'];

    public function address() {
        return $this->hasMany(Address::class);
    }
}
