<?php

namespace Mage2\Catalog\Helpers;

use Mage2\Catalog\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryHelper {

    public $websiteId;
    public $defaultWebsiteId;
    public $isDefaultWebsite;

    //public $theme;

    public function __construct() {

        $this->websiteId = Session::get('website_id');
        $this->defaultWebsiteId = Session::get('default_website_id');
        $this->isDefaultWebsite = Session::get('is_default_website');
    }

    public function getCategoryOptions() {
        $options = Category::pluck('name', 'id');
        return $options;
    }

}
