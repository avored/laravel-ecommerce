<?php

namespace App;

use App\Order;
use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['customer_id','first_name','last_name','phone','address_1','address_2','country_id'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
