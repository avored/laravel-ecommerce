<?php
namespace AvoRed\Ecommerce\Models\Database;

use AvoRed\Framework\Models\Database\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'shipping_address_id',
        'billing_address_id',
        'user_id',
        'shipping_option',
        'payment_option',
        'order_status_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'qty', 'tax_amount');
    }

    public function orderProductVariation()
    {
        return $this->hasMany(OrderProductVariation::class,'');
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderReturnRequest() {
        return $this->hasOne(OrderReturnRequest::class);
    }

    public function getShippingAddressAttribute()
    {
        $shippingAddress = Address::findorfail($this->attributes['shipping_address_id']);

        return $shippingAddress;
    }

    public function getOrderStatusTitleAttribute()
    {
        return $this->orderStatus->title;
    }

    public function getBillingAddressAttribute()
    {
        $address = Address::findorfail($this->attributes['billing_address_id']);

        return $address;
    }
}
