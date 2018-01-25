<?php
namespace Mage2\Ecommerce\Models\Database;

class Page extends BaseModel
{
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description'];
}
