<?php

namespace AvoRed\Ecommerce\Models\Database;

class Menu extends BaseModel
{
    protected $fillable = ['name','url', 'parent_id'];
}
