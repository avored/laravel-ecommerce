<?php

namespace Mage2\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Mage2\Attribute\Models\ProductAttribute;
class ProductDatetimeValue extends Model {

    protected $fillable = ['website_id','product_id', 'attribute_id', 'value'];
    protected $dates = ['created_at', 'updated_at', 'value'];

    public function setValueAttribute($value) {
        $value = date('Y-m-d h:m:s', strtotime($value));
        $this->attributes['value'] = $value ;
    }
    
    public function getValueAttribute() {
        return $this->attributes['value'] = Carbon::createFromTimestamp(strtotime($this->attributes['value']));
    }

    public function productAttribute() {
        $this->belongsTo(ProductAttribute::class);
    }

}
