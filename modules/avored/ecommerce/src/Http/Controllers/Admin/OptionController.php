<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use AvoRed\Framework\Repository\Product;
use AvoRed\Framework\Image\Facade as Image;
use Illuminate\Support\Facades\File;

class OptionController extends AdminController
{


    /**
     * AvoRed Attribute Repository
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $productRepository;

    /**
     * ProductController constructor to Set AvoRed Attribute Repository Property.
     *
     * @param \AvoRed\Framework\Repository\Product $repository
     * @return void
     */
    public function __construct(Product $repository)
    {
        $this->productRepository = $repository;
    }


    public function optionCombinationModal(Request $request) {

        $options = Collection::make([]);

        $productId      = $request->get('product_id');
        $attributeIds   = $request->get('attributes');

        foreach ($attributeIds as $attributeId) {
            $options->push($this->productRepository->findAttributeById($attributeId));
        }

        return view('avored-ecommerce::admin.product.option-combination')
                ->with('options', $options)
                ->with('productId', $productId);
    }

    public function editOptionCombinationModal(Request $request) {
        //
        $subProduct = $this->productRepository->findProductById($request->get('id'));
        $attributes = Collection::make([]);

        $productId      = $request->get('product_id');
        $attributeIds   = $request->get('attributes');

        foreach ($attributeIds as $attributeId) {
            $attributes->push($this->productRepository->findAttributeById($attributeId));
        }

        return view('avored-ecommerce::admin.product.option-combination-edit')
                                ->with('options', $attributes)
                                ->with('model', $subProduct)
                                ->with('productId', $productId);
    }

    public function optionCombinationUpdate(Request $request){

        $attributeIds   = Collection::make([]);
        $productId      = $request->get('product_id');
        $parentProduct  = $this->productRepository->findProductById($productId);

        $name = $parentProduct->name;

        foreach ($request->get('attributes_specification') as  $attributeId => $value) {
            $attribute = $this->productRepository->findAttributeById($attributeId);


            if($attribute->field_type == 'SELECT') {
                $attributeOptionModel  = $this->productRepository->attributeModel()->dropDownOptionModel()->findorfail($value);
                $name .= " " . $attributeOptionModel->display_text;
            }

            $attributeIds->push($attributeId);
        }

        $parentProduct->attribute()->sync($attributeIds);

        if(null !== $request->file('image')) {


            $image = $this->_uploadImage($request);
            $tmp = $this->_getTmpString();
            $request->merge(['image' => [$tmp => ['path' => $image->relativePath ]]]);
        }
        /*
        <input type="hidden" name="image[{{ $tmp }}][path]" value="{{ $image->relativePath }}"/>
        */

        if(null === $request->get('sub_product_id')) {
            $combinationProduct = $this->productRepository->model()->create(['name' => $name,'type' => 'VARIATION-COMBINATION']);

            ProductCombination::create(['product_id' => $productId,'combination_id' => $combinationProduct->id]);
            $combinationProduct->saveProduct($request);
        } else {

            $subProduct = $this->productRepository->model()->findorfail($request->get('sub_product_id'));

            if(null !== $request->file('image')) {

                $path = $subProduct->images()->first()->path;

                if (File::exists($path->relativePath)) {
                    File::delete(public_path() . $path->relativePath);
                }

                $subProduct->images()->delete();
            }

            $subProduct->saveProduct($request);

        }


        return redirect()->route('admin.product.edit', $productId);

    }

    /**
     * upload image file and re sized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    private function _uploadImage(Request $request)
    {
        $image = $request->file('image');
        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/catalog/images/' . implode('/', $tmpPath);

        $dbPath = $checkDirectory . "/" . $image->getClientOriginalName();

        $image = Image::upload($image, $checkDirectory);


        return $image;
    }
    /**
     * return random string only lower and without digits.
     *
     * @param int $length
     * @return string $randomString
     */
    private function _getTmpString($length = 6)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
