<?php
namespace Mage2\Ecommerce\Models\Database;

class AttributeDropdownOption extends BaseModel
{
    protected $fillable = ['attribute_id', 'display_text'];

    /**
     * Attribute Dropdown Options belongs to one Product Attribute.
     *
     * @return \Mage2\Ecommerce\Models\Database\Attribute
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
