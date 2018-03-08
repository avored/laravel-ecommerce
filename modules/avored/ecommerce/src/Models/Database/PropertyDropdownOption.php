<?php
namespace AvoRed\Ecommerce\Models\Database;

class PropertyDropdownOption extends BaseModel
{
    protected $fillable = ['property_id', 'display_text'];

    /**
     * Proerty Dropdown Options belongs to one Product Property.
     *
     * @return \AvoRed\Ecommerce\Models\Database\Property
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
