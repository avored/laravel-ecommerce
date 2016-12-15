<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->integer('product_attribute_group_id');
            $table->string('title');
            $table->string('identifier')->unique();
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'SELECT', 'FILE', 'DATETIME']);
            $table->enum('type', ['VARCHAR', 'TEXT', 'INTEGER', 'FLOAT', 'DATETIME', 'FILE']);
            $table->tinyInteger('is_system')->default(0);
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
