<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('identifier')->unique();
            $table->enum('field_type',['TEXT','TEXTAREA','SELECT','FILE','DATETIME']);
            $table->enum('type',['VARCHAR','TEXT','INTEGER','FLOAT','DATETIME','FILE']);
            $table->string('validation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:drop('product_attributes');
    }
}
