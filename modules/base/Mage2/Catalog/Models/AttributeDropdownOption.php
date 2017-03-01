<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class AttributeDropdownOption extends BaseModel
{
    protected $fillable = ['product_attribute_id', 'display_text'];

    /**
     * Attribute Dropdown Options belongs to many Product Attribute.
     *
     * @return \Mage2\Catalog\Models\ProductAttribute
     */
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
