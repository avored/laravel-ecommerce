<?php

namespace App\Http\Controllers;

use Mage2\Admin\Eloquents\Repository\CategoryRepository;
use Mage2\Admin\Eloquents\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryViewController extends Controller
{
    /**
     * @var AddressRepository
     */
    protected $categoryRepository;

    public function __construct(CategoryRepository $repository){
        $this->categoryRepository = $repository;
        parent::__construct();
    }

    public function view($slug) {

        $category = $this->categoryRepository->where('slug','=',$slug)->get()->first();

        return view($this->theme. 'category.view')
                    ->with('category', $category)
            ;

    }
}
