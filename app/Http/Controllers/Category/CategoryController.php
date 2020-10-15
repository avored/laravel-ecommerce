<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryFilterRepository
     */
    protected $categoryFilterRepository;

    /**
     * home controller construct.
     * @param \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     * @param \AvoRed\Framework\Database\Repository\CategoryFilterRepository $categoryFilterRepository
     */
    public function __construct(
        CategoryModelInterface $categoryRepository,
        CategoryFilterModelInterface $categoryFilterRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFilterRepository = $categoryFilterRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, string $slug)
    {
        $request->merge(['slug' => $slug]);
        $category = $this->categoryRepository->findBySlug($slug);
        $categoryProducts = $this->categoryRepository->getCategoryProducts($request);
        $categoryFilters = $this->categoryFilterRepository->findByCategoryId($category->id);

        return view('category.show')
            ->with(compact('categoryFilters', 'categoryProducts', 'category'));
    }
}
