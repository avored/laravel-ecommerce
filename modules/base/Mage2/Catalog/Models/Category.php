<?php

namespace Mage2\Catalog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Mage2\Framework\Http\Models\BaseModel;
use Mage2\Install\Models\Website;

class Category extends BaseModel
{
    protected $fillable = ['website_id', 'parent_id', 'name', 'slug'];
    protected $websiteId;
    protected $defaultWebsiteId;
    protected $isDefaultWebsite;

    public function __construct(array $attributes = [])
    {
        $this->websiteId = Session::get('website_id');
        $this->defaultWebsiteId = Session::get('default_website_id');
        $this->isDefaultWebsite = Session::get('is_default_website');
        parent::__construct($attributes);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getParentNameAttribute()
    {
        $parentCategory = $this->where('id', '=', $this->attributes['parent_id'])->get()->first();

        return (null != $parentCategory) ? $parentCategory->name : '';
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getAllCategories()
    {
        $data = [];

        $rootCategories = $this->where('parent_id', '=', '0')->where('website_id', '=', $this->websiteId)->get();
        $data = $this->list_categories($rootCategories);

        return $data;
    }

    public function list_categories($categories)
    {
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'object'   => $category,
                'children' => $this->list_categories($category->children),
            ];
        }

        return $data;
    }

    public function getChilds($id)
    {
        return $this->where('parent_id', '=', $id)->get();
    }
}
