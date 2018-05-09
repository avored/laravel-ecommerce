<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Models\Database\AttributeDropdownOption;
use AvoRed\Framework\Models\Database\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use AvoRed\Framework\Models\Database\Product as ProductModel;
use AvoRed\Framework\Image\Facade as Image;
use AvoRed\Ecommerce\Http\Requests\ProductRequest;
use AvoRed\Ecommerce\DataGrid\Product as ProductGrid;

class ProductController extends Controller
{
   

    /**
     * Display a listing of the resource.
     * r.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productGrid = new ProductGrid(ProductModel::where('type', '!=', 'VARIABLE_PRODUCT')->orderBy('id','desc'));

        return view('avored-ecommerce::product.index')->with('dataGrid', $productGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::product.create');
    }

    /**
     * Store a newly created resource in storage.
     * @todo Change the ProductRequest Validation Rules for Store and Update
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $product = ProductModel::create($request->all());

        } catch (\Exception $e) {
            echo 'Error in Saving Product: ', $e->getMessage(), "\n";
        }

        //rather then redirect we just execute Edit Method here.
        // Not sure if this is a good idea???

        return redirect()->route('admin.product.edit', ['id' => $product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = ProductModel::findorfail($id);
        $attributes = Collection::make([]);

        $properties                  = Property::all()->pluck('name', 'id');
        $usedForAllProductProperties = Property::whereUseForAllProducts(1)->get();



        if ($product->hasVariation() == 'VARIATION') {
            $attributes = AttributeDropdownOption::all()->pluck('name', 'id');
        }

        return view('avored-ecommerce::product.edit')
            ->with('model', $product)
            ->with('propertyOptions', $properties)
            ->with('usedForAllProductProperties',$usedForAllProductProperties)
            ->with('attributeOptions', $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\ProductRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Exception
     */
    public function update(ProductRequest $request, $id)
    {
        try {

            $product = ProductModel::findorfail($id);
            $product->saveProduct($request->all());

        } catch (\Exception $e) {
            throw new \Exception('Error in Saving Product: '.$e->getMessage());
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        ProductModel::destroy($id);

        return redirect()->route('admin.product.index');
    }

    /**
     * upload image file and re sized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $image = $request->file('image');
        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/catalog/images/'.implode('/', $tmpPath);

        $dbPath = $checkDirectory.'/'.$image->getClientOriginalName();

        $image = Image::upload($image, $checkDirectory);

        $tmp = $this->_getTmpString();

        return view('avored-ecommerce::product.upload-image')
            ->with('image', $image)
            ->with('tmp', $tmp);
    }

    /**
     * upload image file and resized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        $path = $request->get('path');

        if (File::exists($path)) {
            File::delete(public_path().$path);
        }

        return JsonResponse::create(['success' => true]);
    }

    /**
     * upload image file and resized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editVariation(Request $request)
    {
        $product = ProductModel::findorfail($request->get('variation_id'));
        $view = view('avored-ecommerce::product.variation-modal')
                            ->with('model', $product);

        return new JsonResponse(['success' => true, 'content' => $view->render(), 'modalId' => '#variation-modal-'.$product->id]);
    }

    /**
     * return random string only lower and without digits.
     *
     * @param int $length
     * @return string $randomString
     */
    public function _getTmpString($length = 6)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
