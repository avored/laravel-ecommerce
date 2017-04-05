<?php

namespace Mage2\Catalog\Models;

use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\User\Models\User;

class Review extends BaseModel
{
    protected $fillable = ['product_id', 'user_id', 'star', 'comment', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductTitleAttribute() {
        return $this->product->title;
    }


    public function getUserNameAttribute() {
        return $this->user->full_name;
    }
}
