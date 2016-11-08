<?php

namespace Mage2\TaxClass\Models;

use Mage2\Framework\System\Models\BaseModel;

class TaxClass extends BaseModel
{
    protected $fillable = [
                    'title',
                    'country_code',
                    'state_code',
                    'post_code',
                    'percentage',
                    'priority',
    ];
}
