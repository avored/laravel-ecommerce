<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Database\Product;

class SearchController extends Controller
{
    public function result(Request $request)
    {
        $queryParam = $request->get('q');

        $products = Product::where('name', 'like', '%' . $queryParam . '%')
            ->where('status', '=', 1)->paginate(9);

        return view('search.results')
            ->with('queryParam', $queryParam)
            ->with('products', $products);
    }
}
