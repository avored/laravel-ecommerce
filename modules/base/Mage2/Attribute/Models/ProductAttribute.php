<?php

namespace Mage2\Attribute\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductAttribute extends BaseModel
{
    protected $fillable = ['title', 'identifier', 'field_type', 'type', 'validation'];

    /**
     * Product Attribute has many Attribute Dropdown Options.
     *
     * @return \Mage2\Attribute\Models\AttributeDropdownOption
     */
    public function attributeDropdownOptions()
    {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    /**
     * Product Attribute has many Product Varchar Value.
     *
     * @return \Mage2\Attribute\Models\ProductVarcharValue
     */
    public function productVarcharValues()
    {
        return $this->hasMany(ProductVarcharValue::class);
    }

    /**
     * Product Attribute has many Product Date Time Value.
     *
     * @return \Mage2\Attribute\Models\ProductDatetimeValue
     */
    public function productDatetimeValues()
    {
        return $this->hasMany(ProductDatetimeValue::class);
    }

    /**
     * Product Attribute has many Product Float Value.
     *
     * @return \Mage2\Attribute\Models\ProductFloatValue
     */
    public function productFloatValues()
    {
        return $this->hasMany(ProductFloatValue::class);
    }

    /**
     * Product Attribute has many Product Integer Value.
     *
     * @return \Mage2\Attribute\Models\ProductIntegerValue
     */
    public function productIntegerValues()
    {
        return $this->hasMany(ProductIntegerValue::class);
    }

    /**
     * Product Attribute has many Product Text Value.
     *
     * @return \Mage2\Attribute\Models\ProductTextValue
     */
    public function productTextValues()
    {
        return $this->hasMany(ProductTextValue::class);
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
