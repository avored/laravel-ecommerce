<?php

namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use AvoRed\Framework\Repository\Product;
use AvoRed\Framework\Image\Facade as Image;
use AvoRed\Ecommerce\Events\ProductAfterSave;
use AvoRed\Ecommerce\Events\ProductBeforeSave;
use AvoRed\Ecommerce\Http\Requests\ProductRequest;
use AvoRed\Ecommerce\DataGrid\Product as ProductGrid;

class ProductController extends AdminController
{
    /**
     * AvoRed Product Repository.
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $productRepository;

    /**
     * ProductController constructor to Set AvoRed Product Repository Property.
     *
     * @param \AvoRed\Framework\Repository\Product $repository
     * @return void
     */
    public function __construct(Product $repository)
    {
        $this->productRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     * r.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productGrid = new ProductGrid($this->productRepository->model()->where('type', '!=', 'VARIABLE_PRODUCT'));

        return view('avored-ecommerce::admin.product.index')->with('dataGrid', $productGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     * @todo Change the ProductRequest Validation Rules for Store and Update
     *
     * @param \AvoRed\Ecommerce\Http\Requests\ProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $product = $this->productRepository->model()->create($request->all());
        } catch (\Exception $e) {
            echo 'Error in Saving Product: ', $e->getMessage(), "\n";
        }

        //rather then redirect we just execute Edit Method here.
        // Not sure if this is a good idea???

        //return $this->edit($product->id);
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
        $product = $this->productRepository->model()->findorfail($id);

        $attributes = Collection::make([]);
        $properties = $this->productRepository->propertyModel()->all()->pluck('name', 'id');

        if ($product->hasVariation() == 'VARIATION') {
            $attributes = $this->productRepository->attributeModel()->all()->pluck('name', 'id');
        }

        return view('avored-ecommerce::admin.product.edit')
            ->with('model', $product)
            ->with('propertyOptions', $properties)
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
            Event::fire(new ProductBeforeSave($request));
            $product = $this->productRepository->model()->findorfail($id);
            $product->saveProduct($request);
            Event::fire(new ProductAfterSave($product, $request));
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
        $this->productRepository->model()->destroy($id);

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

        return view('avored-ecommerce::admin.product.upload-image')
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
        $product = $this->productRepository->model()->findorfail($request->get('variation_id'));
        $view = view('avored-ecommerce::admin.product.variation-modal')
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
