<?php
namespace AvoRed\Ecommerce\Models\Database;

class Property extends BaseModel
{
    protected $fillable = ['name', 'identifier', 'data_type','field_type' ,'sort_order'];


    public function propertyDropdownOptions() {
        return $this->hasMany(PropertyDropdownOption::class);
    }

}


