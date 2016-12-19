<?php

namespace Mage2\Catalog\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Catalog\Models\ProductAttribute;

class ProductAttributeGroup extends Model
{
    protected $fillable = ['title','identifier','sort_order'];
    
    
    public function productAttributes() {
        return $this->hasMany(ProductAttribute::class);
    }
}
