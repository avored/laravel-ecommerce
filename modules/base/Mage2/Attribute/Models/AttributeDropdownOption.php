<?php

namespace Mage2\Attribute\Models;

use Mage2\Framework\System\Models\BaseModel;

class AttributeDropdownOption extends BaseModel
{
    protected $fillable = ['product_attribute_id', 'value', 'label'];

    /**
     * Attribute Dropdown Options belongs to many Product Attribute.
     *
     * @return \Mage2\Attribute\Models\ProductAttribute
     */
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
