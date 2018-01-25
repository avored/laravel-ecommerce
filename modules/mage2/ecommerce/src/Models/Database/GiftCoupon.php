<?php
namespace Mage2\Ecommerce\Models\Database;

use Carbon\Carbon;

class GiftCoupon extends BaseModel
{
    protected $fillable = ['name', 'code', 'discount', 'start_date', 'end_date', 'status'];

    protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];

    public function getStartDateAttribute($val, $format = true)
    {
        $value = Carbon::createFromTimestamp(strtotime($val));

        if (true === $format) {
            return $value->format('d-M-Y');
        }

        return $value;
    }

    public function setStartDateAttribute($val)
    {
        $value = Carbon::createFromTimestamp(strtotime($val));
        $this->attributes['start_date'] = $value->toDateString();
    }

    public function getEndDateAttribute($val, $format = true)
    {
        $value = Carbon::createFromTimestamp(strtotime($val));

        if (true === $format) {
            return $value->format('d-M-Y');
        }

        return $value;
    }

    public function setEndDateAttribute($val)
    {
        $value = Carbon::createFromTimestamp(strtotime($val));
        $this->attributes['end_date'] = $value->toDateString();
    }
}
