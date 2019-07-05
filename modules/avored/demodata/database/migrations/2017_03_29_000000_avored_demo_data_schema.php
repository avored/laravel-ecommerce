<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\ProductImage;
use Faker\Factory;

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

        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Sofa Set',
            'slug' => 'avored-sofa-set',
            'sku' => 'avored-sofa-set',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-sofa-set.png', 'product_id' => $product->id, 'is_main_image' => 1]);  
        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Single Bed',
            'slug' => 'avored-single-bed',
            'sku' => 'avored-single-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-single-bed.png', 'product_id' => $product->id, 'is_main_image' => 1]);  
        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Double Bed',
            'slug' => 'avored-double-bed',
            'sku' => 'avored-double-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-double-bed.png', 'product_id' => $product->id, 'is_main_image' => 1]);  
        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Queen Bed',
            'slug' => 'avored-queen-bed',
            'sku' => 'avored-queen-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-queen-bed.png', 'product_id' => $product->id, 'is_main_image' => 1]);  
        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'AvoRed Bunk Bed',
            'slug' => 'avored-bunk-bed',
            'sku' => 'avored-bunk-bed',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-bunk-bed.png', 'product_id' => $product->id, 'is_main_image' => 1]);  
        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'PHP Sofa Set',
            'slug' => 'php-sofa-set',
            'sku' => 'php-sofa-set',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
        ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/php-sofa-set.png', 'product_id' => $product->id, 'is_main_image' => 1]);
        
        
        $price = rand(500, 1000) / 10;
        $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Laravel Sofa Set',
            'slug' => 'laravel-sofa-set',
            'sku' => 'laravel-sofa-set',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
            ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/laravel-sofa-set.png', 'product_id' => $product->id, 'is_main_image' => 1]);
            
            $price = rand(500, 1000) / 10;
            $product = Product::create([
                'type' => 'BASIC',
                'name' => 'PHP Single Mattress',
                'slug' => 'php-single-mattress',
                'sku' => 'php-sofa-set',
                'barcode' => '123456789',
                'descriptiopn' => $faker->text,
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
            ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/php-single-mattress.png', 'product_id' => $product->id, 'is_main_image' => 1]);

            $price = rand(500, 1000) / 10;
            $product = Product::create([
            'type' => 'BASIC',
            'name' => 'Laravel Bedside Table',
            'slug' => 'laravel-bedside-table',
            'sku' => 'laravel-bedside-table',
            'barcode' => '123456789',
            'descriptiopn' => $faker->text,
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
            ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/laravel-bedside-table.png', 'product_id' => $product->id, 'is_main_image' => 1]);
            


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
