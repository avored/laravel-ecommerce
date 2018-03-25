<?php

namespace AvoRed\Ecommerce\Models\Database;

class Module extends BaseModel
{
    protected $fillable = ['identifier', 'type', 'name', 'status'];

    public function getModuleByIdentifier($identifier)
    {
        return $this->where('identifier', '=', $identifier)->get()->first();
    }
}
