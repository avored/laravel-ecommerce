<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductVariation extends BaseModel
{
    protected $fillable = ['product_id','sub_product_id','product_attribute_id','attribute_dropdown_option_id'];

    /**
     * Variation belongs to Product
     *
     * @return \Mage2\Catalog\Models\Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Variation belongs to Product
     *
     * @return \Mage2\Catalog\Models\Product
     */
    public function subProduct()
    {
        return $this->belongsTo(Product::class,'sub_product_id');
    }

    /**
     * Variation belongs to Product
     *
     * @return \Mage2\Catalog\Models\Product
     */
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    /**
     * Variation belongs to Attribute Dropdown Option.
     *
     * @return \Mage2\Catalog\Models\AttributeDropdownOption
     */
    public function attributeDropdownOption()
    {
        return $this->belongsTo(AttributeDropdownOption::class);
    }
}
