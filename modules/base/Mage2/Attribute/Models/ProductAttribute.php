<?php

namespace Mage2\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Attribute\Models\AttributeDropdownOption;
use Mage2\Attribute\Models\ProductVarcharValue;
use Mage2\Attribute\Models\ProductTextValue;
use Mage2\Attribute\Models\ProductDatetimeValue;
use Mage2\Attribute\Models\ProductIntegerValue;
use Mage2\Attribute\Models\ProductFloatValue;


class ProductAttribute extends Model
{
    protected $fillable = ['title','identifier','field_type','type','validation'];


    public function attributeDropdownOptions() {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    public function productVarcharValues() {
        return $this->hasMany(ProductVarcharValue::class);
    }

    public function productDatetimeValues() {
        return $this->hasMany(ProductDatetimeValue::class);
    }

    public function productFloatValues() {
        return $this->hasMany(ProductFloatValue::class);
    }

    public function productIntegerValues() {
        return $this->hasMany(ProductIntegerValue::class);
    }

    public function productTextValues() {
        return $this->hasMany(ProductTextValue::class);
    }
    
    public function getTrackStockOptions() {
        $attribute = $this->where('identifier','=','track_stock')->get()->first();
        return $attribute->attributeDropdownOptions->pluck('label','value');
    }
    public function getIsTaxableOptions() {
        $attribute = $this->where('identifier','=','is_taxable')->get()->first();
        
        return $attribute->attributeDropdownOptions->pluck('label','value');
    }

    public function getInStockOptions() {
        $attribute = $this->where('identifier','=','in_stock')->get()->first();
        return $attribute->attributeDropdownOptions->pluck('label','value');
    }
    public function getIsFeaturedOptions() {
        $attribute = $this->where('identifier','=','is_featured')->get()->first();
        return $attribute->attributeDropdownOptions->pluck('label','value');
    }
    public function getStatusOptions() {
        $attribute = $this->where('identifier','=','status')->get()->first();
        return $attribute->attributeDropdownOptions->pluck('label','value');
    }
}
