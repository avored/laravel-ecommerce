<?php

namespace Mage2\Catalog\Models;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\Product;

use Mage2\Framework\System\Models\BaseModel;

class ProductVarcharValue extends BaseModel
{
    protected $fillable = ['product_attribute_id', 'product_id','value'];

    /**
     * Attribute Dropdown Options belongs to many Product Attribute.
     *
     * @return \Mage2\Catalog\Models\ProductAttribute
     */
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    /**
     * Attribute Dropdown Options belongs to many Product Attribute.
     *
     * @return \Mage2\Catalog\Models\ProductAttribute
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
