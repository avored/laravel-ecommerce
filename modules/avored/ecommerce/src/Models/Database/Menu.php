<?php

namespace AvoRed\Ecommerce\Models\Database;

class Menu extends BaseModel
{
    protected $fillable = ['name','route', 'params' ,'parent_id'];

    public function children()
    {
        return $this->whereParentId($this->attributes['id'])->get();
    }
}
