<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Repository\Product;

class SearchController extends Controller
{

    /**
     * AvoRed E commerce Product Repository
     *
     * @var \AvoRed\Framework\Repository\Product
     *
     */
    public $productRepository;

    /**
     * Search Controller Setting Product Repository Property of Class.
     *
     * @var \AvoRed\Framework\Repository\Product
     * @return void
     */
    public function __construct(Product $repository)
    {
        parent::__construct();

        $this->productRepository  = $repository;
    }

    public function result(Request $request)
    {

        $queryParam = $request->get('q');

        $products = $this->productRepository->model()->where('name', 'like', "%" . $queryParam . "%")
            ->where('status', '=', 1)->paginate(9);

        return view('search.results')
            ->with('queryParam', $queryParam)
            ->with('products', $products);


    }

}
