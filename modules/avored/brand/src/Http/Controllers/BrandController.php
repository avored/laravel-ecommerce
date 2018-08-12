<?php

namespace AvoRed\Brand\Http\Controllers;

use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Database\ProductPropertyIntegerValue;
use AvoRed\Framework\Models\Database\Property;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index($id) {
        $property = Property::whereIdentifier('avored-brand')->first();

        $productIds  = ProductPropertyIntegerValue::wherePropertyId($property->id)
                                                    ->whereValue($id)
                                                    ->get()->pluck('product_id');

        $products = Product::whereIn('id', $productIds->toArray())->paginate(10);

        return view('avored-brand::brand.index')->with('products', $products);
    }
}
