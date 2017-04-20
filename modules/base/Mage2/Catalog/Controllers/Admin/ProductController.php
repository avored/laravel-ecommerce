<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Catalog\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Helpers\CategoryHelper;
use Mage2\Catalog\Helpers\ProductHelper;
use Mage2\Catalog\Models\Product;
use Mage2\Catalog\Models\ProductOption;
use Mage2\Catalog\Requests\ProductRequest;
use Mage2\Framework\System\Controllers\AdminController;


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Mage2\Framework\Image\Facades\Image;


class ProductController extends AdminController
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

        $products = Product::where('status','=', 1)->paginate(10);

        return view('mage2catalog::admin.catalog.product.index')
                        ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = $this->categoryHelper->getCategoryOptions();

        return view('mage2catalog::admin.catalog.product.create')
                        ->with('categories', $categories);
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

        try {
            $product = Product::create($request->all());
            $this->productHelper->saveProduct($product, $request);
            $this->productHelper->saveRelatedProducts($product, $request);
            $this->productHelper->saveCategory($product, $request);
            $this->productHelper->saveProductImages($product, $request);
            $this->productHelper->saveProductPrice($product, $request->all());
            $this->productHelper->saveProductAttribute($product, $request);
            $this->productHelper->saveProductExtraAttribute($product, $request);

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

        return view('mage2catalog::admin.catalog.product.edit')
                        ->with('product', $product)
                        ->with('categories', $categories);

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
            $this->productHelper->saveProductPrice($product, $request->all());
            $this->productHelper->saveProductAttribute($product, $request);
            $this->productHelper->saveProductExtraAttribute($product, $request);

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
        $imageAttribute = ProductAttribute::where('identifier', '=', 'image')->get()->first();
        $image = $request->file('image');
        $destinationPath = 'uploads/catalog/images/';
        $relativePath = implode('/', str_split(strtolower(str_random(3)))).'/';
        $image->move($destinationPath.$relativePath, $image->getClientOriginalName());

        $tmp = $this->_getTmpString();
        return view('mage2catalog::admin.catalog.product.upload-image')
                        ->with('path', '/'.$destinationPath.$relativePath.$image->getClientOriginalName())
                        ->with('tmp', $tmp)
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
        $titleCollection = $titleAttribute->productVarcharValues()->where('value', 'like', '%'.$query.'%')->get();

        foreach ($titleCollection as $row) {
            $results[] = ['id' => $row->product_id, 'text' => $row->value];
        }

        return response()->json(['results' => $results]);
    }


    public function getAttribute(Request $request) {

        $attribute = ProductAttribute::findorfail($request->get('id'));

        return view('mage2catalog::admin.catalog.product.attribute-panel-values')
                    ->with('attribute', $attribute);

    }

    public function _getTmpString($length = 6) {

        $pool = 'abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
