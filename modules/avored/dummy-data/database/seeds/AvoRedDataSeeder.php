<?php

use Illuminate\Database\Seeder;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Database\Product;
use Faker\Factory;
use AvoRed\Framework\Models\Database\ProductImage;
use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Models\Database\Configuration;

class AvoRedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        //$attribute = ProductAttribute::where('identifier', '=', 'is_featured')->first();

        $kitchenCategory = Category::create([
            'parent_id' => null,
            'name' => 'Kitchen',
            'slug' => 'kitchen'
        ]);
        $bedroomCategory = Category::create([
            'parent_id' => null,
            'name' => 'Bedroom',
            'slug' => 'bedroom'
        ]);
        $livingRoomCategory = Category::create([
            'parent_id' => null,
            'name' => 'Living Room',
            'slug' => 'living-room'
        ]);

        $product = Product::create([
            'name' => 'Flower Pot',
            'slug' => 'flower-pot',
            'sku' => 'flower-pot',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => ''
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/f/h/2/flower-pot.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $product = Product::create([
            'name' => 'Classic TV Stand',
            'type' => 'BASIC',
            'slug' => 'classic-tv-stand',
            'sku' => 'classic-tv-stand',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => ''
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/d/0/c/classic-tv-stand.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $product = Product::create([
            'name' => 'Classic Vintage Curtain',
            'type' => 'BASIC',
            'slug' => 'classic-vintage-curtain',
            'sku' => 'classic-vintage-curtain',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => ''
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/y/f/r/textiles-2.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $product = Product::create([
            'name' => 'Comfirtable Couch',
            'type' => 'BASIC',
            'slug' => 'comfirtable-couch',
            'sku' => 'comfirtable-couch',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => ''
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/1/k/0/-Single-Panel-New-Pastoral-Linen-Blending-Embroidered-Living-Room-font-b-Curtain-b-font-font.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Delicate Brown Curtain',
            'slug' => 'delicate-brown-curtain',
            'sku' => 'delicate-brown-curtain',
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/q/o/m/comfortable-leather-chair-published-under-the-most-comfortable-couch-group.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Medium White Couch';
        $product = Product::create([
            'type' => 'BASIC',
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => ''
        ]);

        $product->categories()->sync($livingRoomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/s/e/j/ff815ea7756de71d6c5edb5566330df6.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Comfirtable Gray Bed';
        $comfirtableGrayBedProduct = Product::create([
            'name' => $title,
            'type' => 'BASIC',
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => ''
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/v/t/x/bed-bedding-comfortable-platform-with-smooth-gray-also-are-beds-and-headboard-plus-small-.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Cute Teddy Bear';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/z/c/u/d5d710257f2cf7cf2576f4a43dc40430.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Minimalist Ceramic Lamp';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/m/2/z/b594a5c88e527b467508aa9fa3b01228.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Wooden Bunk Bed';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        $product->categories()->sync($bedroomCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/4/5/n/il_570xN.262261571.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Cooktail Mixed';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/n/y/n/CC2600.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Coffee Making Machine';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/t/b/n/20121018143846738.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Luxury Cooking Utensil';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(10, 1000),
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/l/i/k/coffee-maker-20.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $title = 'Vintage Toaste';
        $product = Product::create([
            'name' => $title,
            'slug' => str_slug($title),
            'sku' => str_slug($title),
            'description' => $faker->realText(rand(3000, 6000)),
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'price' => rand(2, 10) . '0.' . rand(1, 9) . '0',
            'qty' => rand(10, 1000),
            'is_taxable' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'type' => 'BASIC',
        ]);

        \AvoRed\Framework\Models\Database\Menu::create([
            'name' => $kitchenCategory->name,
            'params' => $kitchenCategory->slug,
            'route' => 'category.view',
        ]);
        \AvoRed\Framework\Models\Database\Menu::create([
            'name' => $bedroomCategory->name,
            'params' => $bedroomCategory->slug,
            'route' => 'category.view',
        ]);
        \AvoRed\Framework\Models\Database\Menu::create([
            'name' => $livingRoomCategory->name,
            'params' => $livingRoomCategory->slug,
            'route' => 'category.view',
        ]);
        \AvoRed\Framework\Models\Database\Menu::create([
            'name' => 'My Account',
            'route' => 'my-account.home',
        ]);
        \AvoRed\Framework\Models\Database\Menu::create([
            'name' => 'Cart',
            'route' => 'cart.view',
        ]);
        \AvoRed\Framework\Models\Database\Menu::create([
            'name' => 'Checkout',
            'route' => 'checkout.index',
        ]);

        $product->categories()->sync($kitchenCategory->id);
        ProductImage::create(['path' => 'storage/uploads/catalog/images/0/y/4/tsf02crsa.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);

        $homePageContent = html_entity_decode('<p>&nbsp;</p><p>&nbsp;</p><p><strong>HOME PAGE FOR AvoRed E COMMERCE LARAVEL OPEN SOURCE SHOPPING CART</strong></p><p>&nbsp;</p><p><strong>Please star us on&nbsp;<a href="https://github.com/avored/laravel-ecommerce">https://github.com/avored/laravel-ecommerce</a></strong></p><p><strong>Like us on Facebook :&nbsp;<a href="https://www.facebook.com/avored/">https://www.facebook.com/avored/</a></strong></p><p><strong>Follow us on Twitter:&nbsp;<a href="https://twitter.com/avoredecommerce/">https://twitter.com/avoredecommerce/</a></strong></p>');
        $homePage = Page::create(['name' => 'Home Page',
                                                                                    'slug' => 'home-page',
                                                                                    'content' => $homePageContent,
                                                                                    'meta_title' => 'Home Page - AvoRed E commerce']);
        Configuration::create(['configuration_key' => 'general_home_page',
                                                                'configuration_value' => $homePage->id]);

        $termPage = Page::create(['name' => 'Term & Condition',
                                'slug' => 'term-condition',
                                'content' => $faker->text(200),
                                'meta_title' => 'Term & Condition - AvoRed E commerce']);
        Configuration::create(['configuration_key' => 'general_term_condition_page',
                                                                'configuration_value' => $termPage->id]);
    }
}
