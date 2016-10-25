<?php

namespace Mage2\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['title', 'is_default'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
