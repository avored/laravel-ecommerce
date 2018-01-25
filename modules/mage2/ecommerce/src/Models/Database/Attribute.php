<?php
namespace Mage2\Ecommerce\Models\Database;

class Attribute extends BaseModel
{
    protected $fillable = ['name', 'identifier', 'data_type','field_type' ,'sort_order'];


    public function attributeDropdownOptions() {
        return $this->hasMany(AttributeDropdownOption::class);
    }

}


