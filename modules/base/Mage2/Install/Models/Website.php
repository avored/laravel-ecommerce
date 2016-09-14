<?php

namespace Mage2\Install\Models;
use Mage2\Catalog\Models\Product;
use Mage2\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['name','host','is_default'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }
}
