<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductAttribute extends BaseModel
{
    protected $fillable = ['title',
                            'product_attribute_group_id' ,
                            'identifier', 
                            'field_type', 
                            'type', 
                            'is_system' ,
                            'sort_order' ,
                            'validation'
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

    public function getDropdownOptionsByAttrubuteIdentifier($identifier) {
        
        $attribute = $this->where('identifier', '=', $identifier)->get()->first();
        return $attribute->attributeDropdownOptions->pluck('label', 'value');
    }

    public function getTrackStockOptions()
    {
        $attribute = $this->where('identifier', '=', 'track_stock')->get()->first();

        return $attribute->attributeDropdownOptions->pluck('label', 'value');
    }

    public function getIsTaxableOptions()
    {
        $attribute = $this->where('identifier', '=', 'is_taxable')->get()->first();

        return $attribute->attributeDropdownOptions->pluck('label', 'value');
    }

    public function getInStockOptions()
    {
        $attribute = $this->where('identifier', '=', 'in_stock')->get()->first();

        return $attribute->attributeDropdownOptions->pluck('label', 'value');
    }

    public function getIsFeaturedOptions()
    {
        $attribute = $this->where('identifier', '=', 'is_featured')->get()->first();

        return $attribute->attributeDropdownOptions->pluck('label', 'value');
    }

    public function getStatusOptions()
    {
        $attribute = $this->where('identifier', '=', 'status')->get()->first();

        return $attribute->attributeDropdownOptions->pluck('label', 'value');
    }
}
