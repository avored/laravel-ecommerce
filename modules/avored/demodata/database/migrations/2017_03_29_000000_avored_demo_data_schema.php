<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Database\Models\Category;

class AvoredDemoDataSchema extends Migration
{
    /**
     * Install the AvoRed Dummy Data Module Schema.
     *
     * @return void
     */
    public function up()
    {
        Category::create([
            'name' => 'Tops',
            'slug' => 'tops'
        ]);
        Category::create([
            'name' => 'Dresses',
            'slug' => 'dresses'
        ]);
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
