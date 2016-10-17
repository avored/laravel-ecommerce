<?php

namespace Mage2\Catalog\Controllers\Admin;

use Mage2\Catalog\Models\Category;
use Mage2\Install\Models\Website;
use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Catalog\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Mage2\Catalog\Models\Product;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Catalog\Models\RelatedProduct;

class ProductController extends Controller {

    //protected $productRepository;
    //protected $websiteRepository;
    //protected $productAttributeRepository;
    //protected $relatedProductRepository;
    //protected $categoryRepository;

    
    public function __construct() {
        //$this->productRepository = $repository;
        //$this->websiteRepository = $websiteRepository;
        //$this->productAttributeRepository = $productAttributeRepository;
        //$this->relatedProductRepository = $relatedProductRepository;
        //$this->categoryRepository = $categoryRepository;
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     * r
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $website = Website::findorfail($this->websiteId);
        $products = $website->products()->paginate(10);

        return view('admin.catalog.product.index')
                        ->with('products', $products)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $websites = Website::pluck('name', 'id');
        $categories = $this->_getCategoryOptions();
        $productAttributes = ProductAttribute::all();
        return view('admin.catalog.product.create')
                        ->with('productAttributes', $productAttributes)
                        ->with('categories', $categories)
                        ->with('websites', $websites)
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mage2\Catalog\Requests\ProductRequest    $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) {
        //return $request->all();
        $product = Product::create();


        $this->_saveProduct($product, $request);
        $this->_saveRelatedProducts($product, $request);
        $this->_saveCategory($product, $request);
        $this->_saveProductImages($product, $request);

        $this->_saveProductAttribute($product, $request);

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $product = Product::findorfail($id);

        $categories = $this->_getCategoryOptions();
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
     * @param  \\App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id) {

        $product = Product::findorfail($id);

        $this->_saveProduct($product, $request);
        $this->_saveRelatedProducts($product, $request);
        $this->_saveCategory($product, $request);

        $this->_saveProductImages($product, $request);
        $this->_saveProductAttribute($product, $request);

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Product::destroy($id);

        return redirect()->route('admin.product.index');
    }

    public function uploadImage(Request $request) {

        $request->merge(['website_id' => $this->websiteId]);
        $imageAttribute = ProductAttribute::where('identifier', '=', 'image')->get()->first();
        $image = $request->file('image');
        $destinationPath = 'uploads/catalog/images/';
        $relativePath = implode("/", str_split(strtolower(str_random(3)))) . "/";
        $image->move($destinationPath . $relativePath, $image->getClientOriginalName());

        return view('admin.catalog.product.upload-image')
                        ->with('path', "/" . $destinationPath . $relativePath . $image->getClientOriginalName())
                        ->with('dbPath', $relativePath . $image->getClientOriginalName());
    }

    public function deleteImage(Request $request) {

        $path = $request->get('path');

        if (File::exists($path)) {
            File::delete(public_path() . $path);
        }

        return 'success';
    }

    public function searchProduct(Request $request) {
        //$results = Collection::make([]);
        $query = $request->get('q');

        $titleAttribute = ProductAttribute::where('identifier', '=', 'title')->get()->first();
        $titleCollection = $titleAttribute->productVarcharValues()->where('value', 'like', "%" . $query . "%")->where('website_id', '=', $this->websiteId)->get();
        //$results = $results->toArray() + $titleCollection->pluck('product_id')->toArray();

        foreach ($titleCollection as $row) {
            $results[] = ['id' => $row->product_id, 'text' => $row->value];
        }

        //var_dump($results);die;


        return response()->json(['results' => $results]);
        //$descriptionAttribute = ProductAttribute::where('identifier','=','description')->get()->first();
        //$descCollection  = $descriptionAttribute->productVarcharValues()->where('value','like', "%" .$query. "%")->get();
        //var_dump(count($descCollection));die;
        //$results->merge($titleCollection->pluck('product_id'));
        //dd($results);


        return $request->all();
    }

    private function _saveProduct($product, ProductRequest $request) {

        if (count($request->get('website_id')) > 0) {
            $product->websites()->sync($request->get('website_id'));
        }
    }

    private function _saveRelatedProducts($product, ProductRequest $request) {

        if (count($request->get('related_products')) > 0) {
            $relatedProducts = [];
            RelatedProduct::where('product_id', '=', $product->id)->delete();
            foreach ($request->get('related_products') as $relatedId) {
                $relatedProducts = ['product_id' => $product->id, 'related_product_id' => $relatedId];
                RelatedProduct::create($relatedProducts);
            }
        }
    }

    private function _saveCategory($product, ProductRequest $request) {

        if (count($request->get('category_id')) > 0) {
            $product->categories()->sync($request->get('category_id'));
        }
    }

    private function _saveProductAttribute($product, ProductRequest $request) {
        $productAttributes = ProductAttribute::all();

        foreach ($productAttributes as $productAttribute) {

            $identifier = $productAttribute->identifier;
            if (null == $request->get($identifier)) {
                continue;
            }
            if ($product->$identifier == $request->get($identifier)) {
                continue;
            }

            switch ($productAttribute->type) {
                case "VARCHAR":
                    $value = $request->get($identifier);
                    $this->_saveProductVarcharValue($product, $identifier, $productAttribute, $value);
                    break;

                case "INTEGER":
                    $value = $request->get($identifier);
                    $this->_saveProductIntegerValue($product, $identifier, $productAttribute, $value);
                    break;

                case "FLOAT":
                    $value = $request->get($identifier);
                    $this->_saveProductFloatValue($product, $identifier, $productAttribute, $value);
                    break;

                case "DATETIME":
                    $value = $request->get($identifier);
                    $this->_saveProductDatetimeValue($product, $identifier, $productAttribute, $value);
                    break;

                case "TEXT":
                    $value = $request->get($identifier);
                    $this->_saveProductTextValue($product, $identifier, $productAttribute, $value);
                    break;

                default:
                    break;
            }
        }
        return true;
    }

    public function _saveProductImages($product, ProductRequest $request) {

        $productAttribute = ProductAttribute::where('identifier', '=', 'image')->get()->first();
        $productAttribute->productVarcharValues()->where('product_id', '=', $product->id)->delete();



        if (count($request->get('image')) <= 0) {
            return true;
        }

        foreach ($request->get('image') as $image) {


            if (is_int($image)) {
                continue;
            }

            $productAttribute->productVarcharValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value' => $image
            ]);
        }
    }

    private function _saveProductVarcharValue($product, $identifier, $productAttribute, $value) {

        $createNewRecord = false;

        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productVarcharValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();

            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (NULL === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productVarcharValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value' => $value
            ]);
        } else {
            $productAttribute->productVarcharValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value' => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductIntegerValue($product, $identifier, $productAttribute, $value) {

        $createNewRecord = false;

        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productIntegerValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();

            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (NULL === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productIntegerValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value' => $value
            ]);
        } else {
            $productAttribute->productIntegerValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value' => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductTextValue($product, $identifier, $productAttribute, $value) {

        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productTextValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();
            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (NULL === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productTextValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value' => $value
            ]);
        } else {
            $productAttribute->productTextValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value' => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductFloatValue($product, $identifier, $productAttribute, $value) {

        
        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productFloatValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();
            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (NULL === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productFloatValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value' => $value
            ]);
        } else {
            $productAttribute->productFloatValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value' => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductDatetimeValue($product, $identifier, $productAttribute, $value) {

        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productDatetimeValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();
            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (NULL === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productDatetimeValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value' => $value
            ]);
        } else {
            $productAttribute->productDatetimeValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value' => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _getCategoryOptions() {
        $options = Category::pluck('name', 'id');
        return $options;
    }

}
