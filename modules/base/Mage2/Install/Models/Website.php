<?php

namespace Mage2\Install\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Catalog\Models\Category;
use Mage2\Catalog\Models\Product;

class Website extends Model
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
