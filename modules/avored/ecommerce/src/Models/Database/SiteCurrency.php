<?php

namespace AvoRed\Ecommerce\Models\Database;

use AvoRed\Framework\Models\Database\Configuration;

class SiteCurrency extends BaseModel
{
    protected $fillable = ['code','name','conversion_rate', 'status' ];

}
