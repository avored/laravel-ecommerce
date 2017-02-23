<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class OptionDropdownValue extends BaseModel
{
    protected $fillable = ['product_option_id', 'display_text'];

    /**
     * Attribute Dropdown Options belongs to many Product Attribute.
     *
     * @return \Mage2\Catalog\Models\ProductOption
     */
    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
