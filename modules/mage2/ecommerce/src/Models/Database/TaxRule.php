<?php
namespace Mage2\Ecommerce\Models\Database;

class TaxRule extends BaseModel
{
    protected $fillable = [
        'name',
        'country_id',
        'state_code',
        'post_code',
        'city',
        'percentage',
        'priority',
    ];

    public function taxGroup()
    {
        return $this->hasMany(TaxGroup::class,'tax_group_tax_rule_pivot');
    }
}
