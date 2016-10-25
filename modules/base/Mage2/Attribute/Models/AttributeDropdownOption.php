<?php

namespace Mage2\Attribute\Models;
use Mage2\Attribute\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;

class AttributeDropdownOption extends Model {

    protected $fillable = ['product_attribute_id','value','label'];
    
    /**
     * Attribute Dropdown Options belongs to many Product Attribute 
     * 
     * @return \Mage2\Attribute\Models\ProductAttribute
     */
    public function productAttribute() {
        return $this->belongsTo(ProductAttribute::class);
    }
}
