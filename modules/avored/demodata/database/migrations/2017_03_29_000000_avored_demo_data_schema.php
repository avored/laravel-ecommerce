<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\ProductImage;
use Faker\Factory;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Models\CategoryFilter;
use AvoRed\Framework\Database\Models\MenuGroup;
use AvoRed\Framework\Database\Models\Page;

class AvoredDemoDataSchema extends Migration
{
    /**
     * Install the AvoRed Dummy Data Module Schema.
     *
     * @return void
     */
    public function up()
    {
        $faker = Factory::create();
        $avoredCategory = Category::create([
            'name' => 'AvoRed',
            'slug' => 'avored'
        ]);
        $phpCategory = Category::create([
            'name' => 'PHP',
            'slug' => 'php'
        ]);
        $laravelCategory = Category::create([
            'name' => 'Laravel',
            'slug' => 'laravel'
        ]);

        $colorAttribute = Attribute::create(
            ['name' => 'Color',
            'slug' => 'color',
            'display_as' => 'IMAGE']
        );
        $redOption = $colorAttribute->dropdownOptions()->create(['display_text' => 'Red', 'path' => 'uploads/catalog/attributes/red-attribute.jpg']);
        $blueOption = $colorAttribute->dropdownOptions()->create(['display_text' => 'Blue', 'path' => 'uploads/catalog/attributes/blue-attribute.png']);
        $yellowOption = $colorAttribute->dropdownOptions()->create(['display_text' => 'Yellow', 'path' => 'uploads/catalog/attributes/yellow-attribute.png']);


        $brandProperty = Property::create(
            ['name' => 'Brand',
            'slug' => 'brand',
            'data_type' => 'INTEGER',
            'field_type' => 'SELECT',
            'use_for_all_products' => 1,
            'use_for_category_filter' => 1,
            'is_visible_frontend' => 1,
            'sort_order' => 10]
        );
        $avoredOption = $brandProperty->dropdownOptions()->create(['display_text' => 'Avored']);
        $phpOption = $brandProperty->dropdownOptions()->create(['display_text' => 'PHP']);
        $laravelOption = $brandProperty->dropdownOptions()->create(['display_text' => 'Laravel']);

        $materialProperty = Property::create(
            ['name' => 'Frame Material',
            'slug' => 'frame-material',
            'data_type' => 'INTEGER',
            'field_type' => 'SELECT',
            'use_for_all_products' => 1,
            'use_for_category_filter' => 1,
            'is_visible_frontend' => 1,
            'sort_order' => 10]
        );
        $oakwoodOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Oak wood']);
        $whiteWoodOption = $materialProperty->dropdownOptions()->create(['display_text' => 'White wood framae']);
        $aluminumFrameOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Aluminium frame']);

        CategoryFilter::create(
            ['category_id' => $avoredCategory->id,
            'filter_id' => $brandProperty->id,
            'type' => 'PROPERTY']
        );
        CategoryFilter::create(
            ['category_id' => $phpCategory->id,
            'filter_id' => $brandProperty->id,
            'type' => 'PROPERTY']
        );
        CategoryFilter::create(
            ['category_id' => $laravelCategory->id,
            'filter_id' => $brandProperty->id,
            'type' => 'PROPERTY']
        );
        CategoryFilter::create(
            ['category_id' => $avoredCategory->id,
            'filter_id' => $materialProperty->id,
            'type' => 'PROPERTY']
        );
        CategoryFilter::create(
            ['category_id' => $phpCategory->id,
            'filter_id' => $materialProperty->id,
            'type' => 'PROPERTY']
        );
        CategoryFilter::create(
            ['category_id' => $laravelCategory->id,
            'filter_id' => $materialProperty->id,
            'type' => 'PROPERTY']
        );

        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Sofa Set',
            'slug' => 'avored-sofa-set',
            'sku' => 'avored-sofa-set',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
        ]);
        $product->categories()->sync([$avoredCategory->id]);
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-sofa-set.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);  
        $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $aluminumFrameOption->id]);
        $product->properties()->sync([$brandProperty->id, $materialProperty->id]);

        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Single Bed',
            'slug' => 'avored-single-bed',
            'sku' => 'avored-single-bed',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
        ]);
        $product->categories()->sync([$avoredCategory->id]);
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-single-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);  
        $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $whiteWoodOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Double Bed',
            'slug' => 'avored-double-bed',
            'sku' => 'avored-double-bed',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
        ]);
        $product->categories()->sync([$avoredCategory->id]);
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-double-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);  
        $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Queen Bed',
            'slug' => 'avored-queen-bed',
            'sku' => 'avored-queen-bed',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
        ]);
        $product->categories()->sync([$avoredCategory->id]);
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-queen-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);  
        $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Bunk Bed',
            'slug' => 'avored-bunk-bed',
            'sku' => 'avored-bunk-bed',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
        ]);
        $product->categories()->sync([$avoredCategory->id]);
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-bunk-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);  
        $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $whiteWoodOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'PHP Sofa Set',
            'slug' => 'php-sofa-set',
            'sku' => 'php-sofa-set',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
        ]);
        $product->categories()->sync([$phpCategory->id]);
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/php-sofa-set.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $phpOption->id]);
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $whiteWoodOption->id]);

        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Laravel Sofa Set',
            'slug' => 'laravel-sofa-set',
            'sku' => 'laravel-sofa-set',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
            ]);
            $product->categories()->sync([$laravelCategory->id]);
            ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/laravel-sofa-set.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
            $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $laravelOption->id]);
            $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


            $price = rand(500, 1000) / 10;
            $product = Product::create([
                'type' => 'BASIC',
                'name' => 'PHP Single Mattress',
                'slug' => 'php-single-mattress',
                'sku' => 'php-sofa-set',
                'barcode' => '123456789',
                'description' => $faker->text,
                'status' => 1,
                'in_stock' => 1,
                'track_stock' => 1,
                'qty' => rand(50, 100),
                'is_taxable' => 1,
                'price' => $price,
                'cost_price' => $price - (rand(50, 100) / 10),
                'weight' => rand(1, 10),
                'height' => rand(1, 10),
                'length' => rand(1, 10),
                'width' => rand(1, 10),
            ]);
            $product->categories()->sync([$phpCategory->id]);
            ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/php-single-mattress.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
            $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $phpOption->id]);
            $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


            $price = rand(500, 1000) / 10;
            $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Laravel Bedside Table',
            'slug' => 'laravel-bedside-table',
            'sku' => 'laravel-bedside-table',
            'barcode' => '123456789',
            'description' => $faker->text,
            'status' => 1,
            'in_stock' => 1,
            'track_stock' => 1,
            'qty' => rand(50, 100),
            'is_taxable' => 1,
            'price' => $price,
            'cost_price' => $price - (rand(50, 100) / 10),
            'weight' => rand(1, 10),
            'height' => rand(1, 10),
            'length' => rand(1, 10),
            'width' => rand(1, 10),
            ]);
            $product->categories()->sync([$laravelCategory->id]);
            ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/laravel-bedside-table.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
            $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $laravelOption->id]);
            $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $aluminumFrameOption->id]);

            $mainMenu = MenuGroup::create(['name' => 'Main Menu', 'identifier' => 'main-menu', 'is_default' => 1]);

            $mainMenu->menus()->create(['name' => $avoredCategory->name, 'url' => '/category/' . $avoredCategory->slug]);
            $mainMenu->menus()->create(['name' => $phpCategory->name, 'url' => '/category/' . $phpCategory->slug]);
            $mainMenu->menus()->create(['name' => $laravelCategory->name, 'url' => '/category/' . $laravelCategory->slug]);
            $mainMenu->menus()->create(['name' => 'Cart', 'url' => '/cart']);
            $mainMenu->menus()->create(['name' => 'Checkout', 'url' => '/checkout']);
            $mainMenu->menus()->create(['name' => 'Login', 'url' => '/login']);
            $mainMenu->menus()->create(['name' => 'Register', 'url' => '/register']);

            $mainAuthMenu = MenuGroup::create(['name' => 'Main Auth Menu', 'identifier' => 'main-auth-menu']);

            $mainAuthMenu->menus()->create(['name' => $avoredCategory->name, 'url' => '/category/' . $avoredCategory->slug]);
            $mainAuthMenu->menus()->create(['name' => $phpCategory->name, 'url' => '/category/' . $phpCategory->slug]);
            $mainAuthMenu->menus()->create(['name' => $laravelCategory->name, 'url' => '/category/' . $laravelCategory->slug]);
            $mainAuthMenu->menus()->create(['name' => 'Cart', 'url' => '/cart']);
            $mainAuthMenu->menus()->create(['name' => 'Checkout', 'url' => '/checkout']);
            $accountMenu = $mainAuthMenu->menus()->create(['name' => 'Account', 'url' => '/account']);
            $mainAuthMenu->menus()->create(['name' => 'Logout', 'url' => '/logout', 'parent_id' => $accountMenu->id]);

            Page::create(
                ['name' => 'HomePage',
                'slug' => 'home-page',
                'content' => '%%%avored-banner%%%']
            );
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::enableForeignKeyConstraints();
    }
}
