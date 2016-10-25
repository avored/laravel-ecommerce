<?php

namespace Mage2\Catalog\Helpers;

use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Category;
use Mage2\Framework\Support\Helper;

class CategoryHelper extends Helper
{
    public $websiteId;
    public $defaultWebsiteId;
    public $isDefaultWebsite;

    //public $theme;

    public function __construct()
    {
        $this->websiteId = Session::get('website_id');
        $this->defaultWebsiteId = Session::get('default_website_id');
        $this->isDefaultWebsite = Session::get('is_default_website');
    }

    public function getCategoryOptions()
    {
        $options = Category::pluck('name', 'id');

        return $options;
    }
}
