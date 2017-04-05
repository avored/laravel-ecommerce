<?php

namespace Mage2\System\Models;

use Mage2\Framework\System\Models\BaseModel;

class Module extends BaseModel {

    protected $fillable = ['identifier', 'type','name','status'];

    
    public function getModuleByIdentifier($identifier) {
        return $this->where('identifier','=',$identifier)->get()->first();
    }
}
