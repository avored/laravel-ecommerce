<?php

namespace Mage2\Catalog\Helpers;

use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Category;

class CategoryHelper
{

    public function getCategoryOptions()
    {
        $options = Category::pluck('name', 'id');

        return $options;
    }
}
