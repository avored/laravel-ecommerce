<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductOption extends BaseModel
{
    protected $fillable = ['title',
                            'identifier', 
                            'field_type', 
                            'type', 
                            'is_system' ,
                            'sort_order' ,
                            'validation'
                            ];

    /**
     * Option Type Dropdown has many Option Dropdown Values.
     *
     * @return \Mage2\Catalog\Models\OptionDropdownValue
     */
    public function optionDropdownValues()
    {
        return $this->hasMany(OptionDropdownValue::class);
    }


}
