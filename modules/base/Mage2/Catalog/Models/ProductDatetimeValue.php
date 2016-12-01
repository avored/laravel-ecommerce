<?php

namespace Mage2\Catalog\Models;

use Carbon\Carbon;
use Mage2\Framework\System\Models\BaseModel;

class ProductDatetimeValue extends BaseModel
{
    protected $fillable = ['website_id', 'product_id', 'attribute_id', 'value'];
    protected $dates = ['created_at', 'updated_at', 'value'];

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = date('Y-m-d h:m:s', strtotime($value));
    }

    public function getValueAttribute()
    {
        return $this->attributes['value'] = Carbon::createFromTimestamp(strtotime($this->attributes['value']));
    }

    public function productAttribute()
    {
        $this->belongsTo(ProductAttribute::class);
    }
}
