<?php

namespace Mage2\TaxClass\Models;

use Mage2\Framework\System\Models\BaseModel;

class TaxRule extends BaseModel
{
    protected $fillable = [
                    'title',
                    'country_id',
                    'state_code',
                    'post_code',
                    'city',
                    'percentage',
                    'priority',
    ];
}
