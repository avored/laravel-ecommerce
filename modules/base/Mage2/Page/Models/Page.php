<?php

namespace Mage2\Page\Models;

use Mage2\Framework\System\Models\BaseModel;

class Page extends BaseModel
{
    protected $fillable = ['title', 'slug', 'content', 'meta_title', 'meta_description'];
}
