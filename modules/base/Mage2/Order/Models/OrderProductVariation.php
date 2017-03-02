<?php

namespace Mage2\Order\Models;

use Mage2\User\Models\Address;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\User\Models\User;

class OrderProductVariation extends BaseModel
{
    protected $fillable = [
                    'product_id',
                    'order_id',
                    'product_variation_id',
                ];

}
