<?php

namespace Mage2\Catalog\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Catalog\Helpers\CategoryHelper;
use Mage2\Catalog\Helpers\ProductHelper;
use Mage2\Catalog\Models\Product;
use Mage2\Catalog\Requests\ProductRequest;
use Mage2\System\Controllers\Controller;
use Mage2\Install\Models\Website;

class ProductController extends Controller
{
    /**
     * @var \Mage2\Catalog\Helpers\CategoryHelper
     */
    protected $categoryHelper;

    /**
     * @var \Mage2\Catalog\Helpers\ProductHelper
     */
    protected $productHelper;

    public function __construct(CategoryHelper $categoryHelper, ProductHelper $productHelper)
    {
        $this->categoryHelper = $categoryHelper;
        $this->productHelper = $productHelper;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * r.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $website = Website::findorfail($this->websiteId);
        $products = $website->products()->paginate(10);

        return view('admin.catalog.product.index')
                        ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $websites = Website::pluck('name', 'id');
        $categories = $this->categoryHelper->getCategoryOptions();
        $productAttributes = ProductAttribute::all();

        return view('admin.catalog.product.create')
                        ->with('productAttributes', $productAttributes)
                        ->with('categories', $categories)
                        ->with('websites', $websites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Catalog\Requests\ProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //return $request->all();

        try {
            $product = Product::create();
            $this->productHelper->saveProduct($product, $request);
            $this->productHelper->saveRelatedProducts($product, $request);
            $this->productHelper->saveCategory($product, $request);
            $this->productHelper->saveProductImages($product, $request);
            $this->productHelper->saveProductAttribute($product, $request);
        } catch (\Exception $e) {
            echo 'Error in Saving Product: ', $e->getMessage(), "\n";
        }


        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $product = Product::findorfail($id);

        $categories = $this->categoryHelper->getCategoryOptions();
        $websites = Website::pluck('name', 'id');
        $productAttributes = ProductAttribute::all();

        return view('admin.catalog.product.edit')
                        ->with('product', $product)
                        ->with('websites', $websites)
                        ->with('categories', $categories)
                        ->with('productAttributes', $productAttributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \\App\Http\Requests\ProductRequest $request
     * @param int                                $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findorfail($id);
            $this->productHelper->saveProduct($product, $request);
            $this->productHelper->saveRelatedProducts($product, $request);
            $this->productHelper->saveCategory($product, $request);

            $this->productHelper->saveProductImages($product, $request);
            $this->productHelper->saveProductAttribute($product, $request);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('admin.product.index');
    }

    public function uploadImage(Request $request)
    {
        $request->merge(['website_id' => $this->websiteId]);
        $imageAttribute = ProductAttribute::where('identifier', '=', 'image')->get()->first();
        $image = $request->file('image');
        $destinationPath = 'uploads/catalog/images/';
        $relativePath = implode('/', str_split(strtolower(str_random(3)))).'/';
        $image->move($destinationPath.$relativePath, $image->getClientOriginalName());

        return view('admin.catalog.product.upload-image')
                        ->with('path', '/'.$destinationPath.$relativePath.$image->getClientOriginalName())
                        ->with('dbPath', $relativePath.$image->getClientOriginalName());
    }

    public function deleteImage(Request $request)
    {
        $path = $request->get('path');

        if (File::exists($path)) {
            File::delete(public_path().$path);
        }

        return 'success';
    }

    public function searchProduct(Request $request)
    {
        $query = $request->get('q');

        $titleAttribute = ProductAttribute::where('identifier', '=', 'title')->get()->first();
        $titleCollection = $titleAttribute->productVarcharValues()->where('value', 'like', '%'.$query.'%')->where('website_id', '=', $this->websiteId)->get();

        foreach ($titleCollection as $row) {
            $results[] = ['id' => $row->product_id, 'text' => $row->value];
        }

        return response()->json(['results' => $results]);
    }
}
