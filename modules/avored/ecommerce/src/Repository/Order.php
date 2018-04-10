<?php

namespace AvoRed\Ecommerce\Repository;

use AvoRed\Framework\Repository\Order as AvoRedOrderRepository;
use AvoRed\Ecommerce\Models\Database\Address;

class Order extends AvoRedOrderRepository
{

    public function getBillingAddressAttribute()
    {
        $address = Address::findorfail($this->attributes['billing_address_id']);

        return $address;
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }


}
