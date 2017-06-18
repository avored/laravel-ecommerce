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

use Illuminate\Database\Migrations\Migration;
use Mage2\Category\Models\Category;
use Mage2\Product\Models\Product;
use Faker\Factory;
use Mage2\Catalog\Models\ProductImage;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVarcharValue;


class Mage2InstallSchema extends Migration
{

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install()
    {

        $faker = Factory::create();


        $attribute = ProductAttribute::where('identifier', '=', 'is_featured')->first();

        $kitchenCategory = Category::create([
            'parent_id' => 0,
            'name' => 'Kitchen',
            'slug' => 'kitchen'
        ]);
        $bedroomCategory = Category::create([
            'parent_id' => 0,
            'name' => 'Bedroom',
            'slug' => 'bedroom'
        ]);
        $livingRoomCategory = Category::create([
            'parent_id' => 0,
            'name' => 'Living Room',
            'slug' => 'living-room'
        ]);


        $product = Product::create([
            'title' => 'Flower Pot',
            'slug' => 'flower-pot',
            'sku' => 'flower-pot',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/f/h/2\flower-pot.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        //$flowerPotProduct->cate

        $product = Product::create([
            'title' => 'Classic TV Stand',
            'slug' => 'classic-tv-stand',
            'sku' => 'classic-tv-stand',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/d/0/c\classic-tv-stand.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $product = Product::create([
            'title' => 'Classic Vintage Curtain',
            'slug' => 'classic-vintage-curtain',
            'sku' => 'classic-vintage-curtain',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/y/f/r\textiles-2.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);
        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $product = Product::create([
            'title' => 'Comfirtable Couch',
            'slug' => 'comfirtable-couch',
            'sku' => 'comfirtable-couch',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/1/k/0\-Single-Panel-New-Pastoral-Linen-Blending-Embroidered-Living-Room-font-b-Curtain-b-font-font.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);

        $product = Product::create([
            'title' => 'Delicate Brown Curtain',
            'slug' => 'delicate-brown-curtain',
            'sku' => 'delicate-brown-curtain',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/q/o/m\comfortable-leather-chair-published-under-the-most-comfortable-couch-group.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);
        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);

        $title = "Medium White Couch";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/s/e/j\ff815ea7756de71d6c5edb5566330df6.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);

        $title = "Comfirtable Gray Bed";
        $comfirtableGrayBedProduct = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/v/t/x\bed-bedding-comfortable-platform-with-smooth-gray-also-are-beds-and-headboard-plus-small-.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $title = "Cute Teddy Bear";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/z/c/u\d5d710257f2cf7cf2576f4a43dc40430.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $title = "Minimalist Ceramic Lamp";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/m/2/z\b594a5c88e527b467508aa9fa3b01228.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);

        $title = "Wooden Bunk Bed";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/4/5/n\il_570xN.262261571.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $title = "Cooktail Mixed";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/n/y/n\CC2600.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);
        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $title = "Coffee Making Machine";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/t/b/n\20121018143846738.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);

        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $title = "Luxury Cooking Utensil";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/l/i/k\coffee-maker-20.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);
        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);


        $title = "Vintage Toaste";
        $product = Product::create([
            'title' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'page_title' => '',
            'page_description' => '',
            'has_variation' => 0,
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => '/uploads/catalog/images/0/y/4\tsf02crsa.jpg', 'product_id' => $product->id]);
        $product->prices()->create(['price' => rand(2, 10) . "0." . rand(1, 9) . "0"]);
        ProductVarcharValue::create([
            'product_id' => $product->id,
            'product_attribute_id' => $attribute->id,
            'value' => $attribute->attributeDropdownOptions->pluck('id')->random()
        ]);

    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall()
    {

    }

}
