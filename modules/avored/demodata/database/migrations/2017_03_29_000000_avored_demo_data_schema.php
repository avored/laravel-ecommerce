<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Product;

class AvoredDemoDataSchema extends Migration
{
    /**
     * Install the AvoRed Dummy Data Module Schema.
     *
     * @return void
     */
    public function up()
    {
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

        // $avoredLaptop = Product::create();
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
