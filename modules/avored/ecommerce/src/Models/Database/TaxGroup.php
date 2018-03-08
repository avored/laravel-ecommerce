<?php
namespace AvoRed\Ecommerce\Models\Database;

class TaxGroup extends BaseModel
{
    protected $fillable = ['name'];

    public function taxRules()
    {
        return $this->belongsToMany(TaxRule::class,'tax_group_tax_rule_pivot');
    }

}
