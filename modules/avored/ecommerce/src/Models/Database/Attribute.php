<?php
namespace AvoRed\Ecommerce\Models\Database;

class Attribute extends BaseModel
{
    protected $fillable = ['name', 'identifier'];//, 'data_type','field_type' ,'sort_order'];


    public function attributeDropdownOptions() {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}


