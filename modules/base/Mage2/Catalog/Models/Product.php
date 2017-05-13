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
namespace Mage2\Catalog\Models;

use Mage2\Framework\Image\LocalImageFile;
use Mage2\TaxClass\Models\TaxRule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\Catalog\Models\Review;
use Illuminate\Support\Facades\Cache;

class Product extends BaseModel {

    protected $fillable = ['title','slug','sku','description','status','in_stock','track_stock','qty','is_taxable','page_title','page_description','has_variation'];

    public static function getCollection() {
        $products = Product::all();
        $productCollection = new ProductCollection();
        $productCollection->setCollection($products);
        return $productCollection;
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function productVariations() {
        return $this->hasMany(ProductVariation::class);
    }

    public function productVarcharValues() {
        return $this->hasMany(ProductVarcharValue::class);
    }


    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function prices() {
        return $this->hasMany(ProductPrice::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function relatedProducts() {
        return $this->hasMany(RelatedProduct::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function getReviews() {
        return $this->reviews()->where('status', '=', 'ENABLED')->get();
    }

    public function getAssignedAttributes() {

        $productVariationsList = $this->productVariations()->get();

        if($productVariationsList->count() >0 ){
            return $productVariationsList->unique('product_attribute_id');
        }

        return [];

    }

    /**
     * return default Image or LocalImageFile Object
     *
     * @return string|\Mage2\Framework\Image\LocalImageFile
     */
    public function getImageAttribute() {
        $defaultPath = "/img/default-product.jpg";


        $image = $this->images()->first();


        if(null === $image) {

            return new LocalImageFile($defaultPath);
        }

        if(  $image->path instanceof LocalImageFile) {
            return  $image;
        }


    }

    public function getAssignedVariationBytAttributeId($attributeId){
        return $this->productVariations()
                        ->where('product_attribute_id','=', $attributeId)
                         ->get();
    }

    /*
     * Calculate Tax amount based on default country and return tax amount
     *
     * @return float $taxAmount
     */

    public function getTaxAmount() {

        $defaultCountryId = Configuration::getConfiguration('mage2_tax_class_default_country_for_tax_calculation');
        $taxRules = TaxRule::where('country_id','=',$defaultCountryId)->orderBy('priority','DESC')->first();
        $price = $this->price;

        $taxAmount = ($taxRules->percentage * $price / 100);

        return $taxAmount;
    }

    /*
     * Get the Price for the Product
     *
     * @return float $value
     */

    public function getPriceAttribute() {
        $row = $this->prices()->first();

        return (isset($row->price)) ? $row->price : null ;
    }

    public function getFeaturedProducts($paginate = 4) {
        $attribute = ProductAttribute::where('identifier', '=', 'is_featured')->get()->first();

        if($attribute == NULL) {
            return null;
        }
        $products = Collection::make([]);
        $varcharValues = $attribute->productVarcharValues()->where('value', '=', 1)->get();

        foreach ($varcharValues as $varcharValue) {
            $products->push(self::findorfail($varcharValue->product_id));
        }

        return $products;
    }

}
