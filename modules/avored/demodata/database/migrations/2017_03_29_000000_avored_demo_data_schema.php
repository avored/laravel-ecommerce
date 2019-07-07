<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\ProductImage;
use Faker\Factory;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Models\CategoryFilter;

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
            ['name' => 'Material',
            'slug' => 'material',
            'data_type' => 'INTEGER',
            'field_type' => 'SELECT',
            'use_for_all_products' => 1,
            'use_for_category_filter' => 1,
            'is_visible_frontend' => 1,
            'sort_order' => 10]
        );
        $leatherOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Soft Leather']);
        $corduroyOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Corduroy']);
        $linenOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Linen fabric']);

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
            'descriptiopn' => $faker->text(),
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
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $linenOption->id]);
        $product->properties()->sync([$brandProperty->id, $materialProperty->id]);

        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Single Bed',
            'slug' => 'avored-single-bed',
            'sku' => 'avored-single-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $corduroyOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Double Bed',
            'slug' => 'avored-double-bed',
            'sku' => 'avored-double-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $leatherOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Queen Bed',
            'slug' => 'avored-queen-bed',
            'sku' => 'avored-queen-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $leatherOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Bunk Bed',
            'slug' => 'avored-bunk-bed',
            'sku' => 'avored-bunk-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $corduroyOption->id]);


        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'PHP Sofa Set',
            'slug' => 'php-sofa-set',
            'sku' => 'php-sofa-set',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
        $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $corduroyOption->id]);

        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Laravel Sofa Set',
            'slug' => 'laravel-sofa-set',
            'sku' => 'laravel-sofa-set',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
            $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $leatherOption->id]);


            $price = rand(500, 1000) / 10;
            $product = Product::create([
                'type' => 'BASIC',
                'name' => 'PHP Single Mattress',
                'slug' => 'php-single-mattress',
                'sku' => 'php-sofa-set',
                'barcode' => '123456789',
                'descriptiopn' => $faker->text(),
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
            $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $leatherOption->id]);


            $price = rand(500, 1000) / 10;
            $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Laravel Bedside Table',
            'slug' => 'laravel-bedside-table',
            'sku' => 'laravel-bedside-table',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text(),
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
            $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $linenOption->id]);
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
