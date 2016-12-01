<?php

namespace Mage2\Order\Models;

use Mage2\User\Models\Address;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\User\Models\User;

class Order extends BaseModel
{
    protected $fillable = [
                    'shipping_address_id',
                    'billing_address_id',
                    'user_id',
                    'shipping_method',
                    'payment_method',
                    'order_status_id',
                ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('price', 'qty');
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function getShippingAddressAttribute()
    {
        $shippingAddress = Address::findorfail($this->attributes['shipping_address_id']);

        return $shippingAddress;
    }

    public function getOrderStatusTitleAttribute() {
        return $this->orderStatus->title;
    }

    public function getBillingAddressAttribute()
    {
        $address = Address::findorfail($this->attributes['billing_address_id']);

        return $address;
    }
}
