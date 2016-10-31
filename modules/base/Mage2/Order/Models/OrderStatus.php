<?php

namespace Mage2\Order\Models;

use Mage2\System\Models\BaseModel;

class OrderStatus extends BaseModel
{
    protected $fillable = ['title', 'is_default'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
