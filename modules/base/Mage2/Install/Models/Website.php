<?php

namespace Mage2\Install\Models;

use Mage2\Catalog\Models\Category;
use Mage2\Catalog\Models\Product;
use Mage2\Framework\Http\Models\BaseModel;

class Website extends BaseModel
{
    protected $fillable = ['name', 'host', 'is_default'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
