<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductAttribute extends BaseModel
{
    protected $fillable = ['title',
                            'identifier', 
                            'field_type',
                            'is_system' ,
                            'sort_order'
                            ];

    /**
     * Product Attribute has many Attribute Dropdown Options.
     *
     * @return \Mage2\Catalog\Models\AttributeDropdownOption
     */
    public function attributeDropdownOptions()
    {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    /**
     * Product Attribute has many Attribute Dropdown Options.
     *
     * @return \Mage2\Catalog\Models\AttributeDropdownOption
     */
    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Product Attribute has many Product Varchar Value.
     *
     * @return \Mage2\Catalog\Models\ProductVarcharValue
     */
    public function productVarcharValues()
    {
        return $this->hasMany(ProductVarcharValue::class);
    }

    /**
     * Product Attribute has many Product Date Time Value.
     *
     * @return \Mage2\Catalog\Models\ProductDatetimeValue
     */
    public function productDatetimeValues()
    {
        return $this->hasMany(ProductDatetimeValue::class);
    }

    /**
     * Product Attribute has many Product Float Value.
     *
     * @return \Mage2\Catalog\Models\ProductFloatValue
     */
    public function productFloatValues()
    {
        return $this->hasMany(ProductFloatValue::class);
    }

    /**
     * Product Attribute has many Product Integer Value.
     *
     * @return \Mage2\Catalog\Models\ProductIntegerValue
     */
    public function productIntegerValues()
    {
        return $this->hasMany(ProductIntegerValue::class);
    }

    /**
     * Product Attribute has many Product Text Value.
     *
     * @return \Mage2\Catalog\Models\ProductTextValue
     */
    public function productTextValues()
    {
        return $this->hasMany(ProductTextValue::class);
    }

}
