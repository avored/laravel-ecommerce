<?php

namespace Mage2\Order\Models;

use Mage2\Framework\System\Models\BaseModel;

class OrderStatus extends BaseModel
{
    protected $fillable = ['title', 'is_default','is_last_stage'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
