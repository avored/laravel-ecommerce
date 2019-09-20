<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvoredBannerSchema extends Migration
{
    /**
     *
     * Install the AvoRed Featured Module Schema
     * @return void
     */
    public function up()
    {

        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->string('image_path')->nullable()->default(null);
            $table->string('alt_text')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('target')->nullable()->default(null);
            $table->enum('status', ['ENABLED','DISABLED'])->default('ENABLED');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }

}
