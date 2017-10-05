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
namespace Mage2\Ecommerce\Models\Database;

use Mage2\ProductInventory\Models\Storage;
use Mage2\Ecommerce\Image\LocalFile;
use Mage2\Attribute\Models\ProductAttribute;
use Illuminate\Support\Collection;
use Mage2\Attribute\Models\ProductVariation;
use Mage2\Attribute\Models\ProductVarcharValue;
use Mage2\Review\Models\Review;
use Mage2\RelatedProduct\Models\RelatedProduct;
use Illuminate\Support\Str;

class Product extends BaseModel
{

    protected $fillable = ['type','name', 'slug', 'sku', 'description',
        'status', 'in_stock', 'track_stock', 'qty', 'is_taxable', 'page_title', 'page_description'];

    public static function getCollection()
    {
        $products = Product::all();
        $productCollection = new ProductCollection();
        $productCollection->setCollection($products);
        return $productCollection;
    }

    public static function boot()
    {
        parent::boot();

        // registering a callback to be executed upon the creation of an activity AR
        static::creating(function($model) {

            // produce a slug based on the activity title
            $slug = Str::slug($model->name);

            // check to see if any other slugs exist that are the same & count them
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            // if other slugs exist that are the same, append the count to the slug
            $model->slug = $count ? "{$slug}-{$count}" : $slug;

        });

    }

    /**
     * Return Product model by Product Slug
     *
     * @param $slug
     * return \Mage2\Ecommerce\Models\Database\Product $product
     */
    public static function getProductBySlug($slug)
    {
        $model = new static;
        return $model->where('slug', '=', $slug)->first();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function storages()
    {
        return $this->belongsToMany(Storage::class);
    }

    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function productVarcharValues()
    {
        return $this->hasMany(ProductVarcharValue::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function relatedProducts()
    {
        return $this->hasMany(RelatedProduct::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getReviews()
    {
        return $this->reviews()->where('status', '=', 'ENABLED')->get();
    }

    public function getAssignedAttributes()
    {

        $productVariationsList = $this->productVariations()->get();

        if ($productVariationsList->count() > 0) {
            return $productVariationsList->unique('product_attribute_id');
        }

        return [];

    }

    /**
     * return default Image or LocalFile Object
     *
     * @return \Mage2\Ecommerce\Image\LocalFile
     */
    public function getImageAttribute()
    {
        $defaultPath = "/img/default-product.jpg";
        $image = $this->images()->where('is_main_image','=',1)->first();


        if (null === $image) {
            return new LocalFile($defaultPath);
        }

        if ($image->path instanceof LocalFile) {
            return $image->path;
        }


    }

    public function getAssignedVariationBytAttributeId($attributeId)
    {
        return $this->productVariations()
            ->where('product_attribute_id', '=', $attributeId)
            ->get();
    }

    /*
     * Calculate Tax amount based on default country and return tax amount
     *
     * @return float $taxAmount
     */

    public function getTaxAmount($price = NULL)
    {

        $defaultCountryId = Configuration::getConfiguration('mage2_tax_class_default_country_for_tax_calculation');
        $taxRule = TaxRule::where('country_id', '=', $defaultCountryId)->orderBy('priority', 'DESC')->first();


        if (null === $price) {
            $price = $this->price;
        }

        if (null === $taxRule) {
            return 0.00;
        }
        $taxAmount = ($taxRule->percentage * $price / 100);

        return $taxAmount;
    }

    /*
     * Get the Price for the Product
     *
     * @return float $value
     */

    public function getPriceAttribute()
    {
        $row = $this->prices()->first();

        return (isset($row->price)) ? $row->price : null;
    }

    public function getFeaturedProducts($paginate = 4)
    {
        $attribute = ProductAttribute::where('identifier', '=', 'is_featured')->get()->first();

        if ($attribute == NULL) {
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
