<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mage2\Catalog\Models\ProductAttributeGroup;
use Mage2\Catalog\Models\AttributeDropdownOption;
use Mage2\Catalog\Models\ProductAttribute;

class Mage2CatalogSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {

        Schema::create('product_attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('identifier');
            $table->integer('sort_order');
            $table->timestamps();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_attribute_group_id');
            $table->string('title');
            $table->string('identifier')->unique();
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME']);
            $table->enum('type', ['VARCHAR', 'TEXT', 'INTEGER', 'FLOAT', 'DATETIME', 'FILE']);
            $table->tinyInteger('is_system')->default(0);
            $table->integer('sort_order')->nullable()->default(0);
            $table->string('validation');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('product_varchar_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_float_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->decimal('value',10,6);
            $table->timestamps();
        });
        Schema::create('product_text_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->text('value');
            $table->timestamps();
        });
        Schema::create('product_integer_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->integer('value');
            $table->timestamps();
        });

        Schema::create('product_datetime_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->timestamp('value');
            $table->timestamps();
        });

        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_attribute_id')->unsigned();
            $table->string('value');
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('websites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('host');
            $table->string('name');
            $table->tinyInteger('is_default');
            $table->timestamps();
        });

        Schema::create('product_website', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('website_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('parent_id')->nullable()->default(NULL);
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('related_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('related_products_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->float('star');
            $table->string('comment');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('DISABLED');
            $table->timestamps();
        });


        //addresses table foreign key setup
        //Schema::table('product_attributes', function (Blueprint $table) {
        //    $table->foreign('product_attribute_group_id')
        //            ->references('id')->on('product_attribute_groups')->onDelete('cascade');
        //});
        //product_varchar_values table foreign key setup
        Schema::table('product_varchar_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_varchar_values table foreign key setup
        Schema::table('product_float_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_text_values table foreign key setup
        Schema::table('product_text_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_integer_values table foreign key setup
        Schema::table('product_integer_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_datetime_values table foreign key setup
        Schema::table('product_datetime_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_datetime_values table foreign key setup
        Schema::table('attribute_dropdown_options', function (Blueprint $table) {
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_website table foreign key setup
        Schema::table('product_website', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
        });

        //categories table foreign key setup
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
        });

        //category_product table foreign key setup
        Schema::table('category_product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        //related_products table foreign key setup
        Schema::table('related_products', function (Blueprint $table) {
            $table->foreign('related_products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        //configurations table foreign key setup



        $productAttributeGroup  = ProductAttributeGroup::create(['title' => 'Basic',
            'identifier' => 'basic',
            'sort_order' => 0
        ]);
        $inventoryGroup         = ProductAttributeGroup::create(['title' => 'Inventory',
            'identifier' => 'inventory',
            'sort_order' => 2
        ]);
        $imageGroup             = ProductAttributeGroup::create(['title' => 'Image',
            'identifier' => 'image',
            'sort_order' => 1
        ]);
        $seoGroup               = ProductAttributeGroup::create(['title' => 'SEO',
            'identifier'=> 'seo',
            'sort_order' => 3
        ]);

        $productAttributeGroup  = ProductAttributeGroup::create(['title' => 'Extra Attributes',
            'identifier' => 'extra-attributes',
            'sort_order' => 4
        ]);



        ProductAttribute::insert([
            [
                'title' => 'Title',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'title',
                'type' => 'VARCHAR',
                'is_system' => 1,
                'sort_order' => 0,
                'field_type' => 'TEXT',
                'validation' => 'required|max:255',
            ],
            [
                'title' => 'Price',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'price',
                'type' => 'FLOAT',
                'is_system' => 1,
                'sort_order' => 4,
                'field_type' => 'TEXT',
                'validation' => 'required|max:16|regex:/^-?\\d*(\\.\\d+)?$/',
            ],
            [
                'title' => 'Image',
                'product_attribute_group_id' => $imageGroup->id,
                'identifier' => 'image',
                'type' => 'FILE',
                'field_type' => 'FILE',
                'is_system' => 1,
                'sort_order' => 0,
                'validation' => '',
            ],
            [
                'title' => 'SKU',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'sku',
                'type' => 'VARCHAR',
                'is_system' => 1,
                'sort_order' => 2,
                'field_type' => 'TEXT',
                'validation' => 'required|max:255',
            ],
            [
                'title' => 'Slug',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'slug',
                'type' => 'VARCHAR',
                'is_system' => 1,
                'sort_order' => 1,
                'field_type' => 'TEXT',
                'validation' => 'required|max:255|alpha_dash',
            ],
            [
                'title' => 'Page Title',
                'product_attribute_group_id' => $seoGroup->id,
                'identifier' => 'page_title',
                'type' => 'VARCHAR',
                'is_system' => 1,
                'sort_order' => 0,
                'field_type' => 'TEXT',
                'validation' => 'max:255',
            ],
            [
                'title' => 'Page Description',
                'product_attribute_group_id' => $seoGroup->id,
                'identifier' => 'page_description',
                'type' => 'VARCHAR',
                'field_type' => 'TEXTAREA',
                'is_system' => 1,
                'sort_order' => 1,
                'validation' => 'max:255',
            ],
            [
                'title' => 'Qty',
                'product_attribute_group_id' => $inventoryGroup->id,
                'identifier' => 'qty',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'is_system' => 1,
                'sort_order' => 2,
                'validation' => '',
            ],
            [
                'title' => 'Description',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'description',
                'type' => 'TEXT',
                'field_type' => 'CKEDITOR',
                'is_system' => 1,
                'sort_order' => 3,
                'validation' => 'required',
            ],
        ]);

        $statusAttribute = ProductAttribute::create([
            'title' => 'Status',
            'product_attribute_group_id' => $productAttributeGroup->id,
            'identifier' => 'status',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'is_system' => 1,
            'sort_order' => 5,
            'validation' => 'required',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $statusAttribute->id,
            'value' => '1',
            'label' => 'Enabled',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $statusAttribute->id,
            'value' => '0',
            'label' => 'Disabled',
        ]);

        $isTaxableAttribute = ProductAttribute::create([
            'title' => 'Is Taxable',
            'product_attribute_group_id' => $inventoryGroup->id,
            'identifier' => 'is_taxable',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'is_system' => 1,
            'sort_order' => 3,
            'validation' => 'required',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $isTaxableAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $isTaxableAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);




        $inStockAttribute = ProductAttribute::create([
            'title' => 'In Stock',
            'product_attribute_group_id' => $inventoryGroup->id,
            'identifier' => 'in_stock',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'is_system' => 1,
            'sort_order' => 0,
            'validation' => 'required',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $inStockAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $inStockAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);

        $trackStockAttribute = ProductAttribute::create([
            'title' => 'Track Stock',
            'product_attribute_group_id' => $inventoryGroup->id,
            'identifier' => 'track_stock',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'is_system' => 1,
            'sort_order' => 0,
            'validation' => '',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $trackStockAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $trackStockAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);





    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {

        Schema::drop('product_attribute_groups');
        Schema::drop('product_attributes');
        Schema::drop('products');
        Schema::drop('product_varchar_values');
        Schema::drop('product_float_values');
        Schema::drop('product_text_values');
        Schema::drop('product_integer_values');
        Schema::drop('product_datetime_values');
        Schema::drop('attribute_dropdown_options');
        Schema::drop('websites');
        Schema::drop('product_website');
        Schema::drop('categories');
        Schema::drop('category_product');
        Schema::drop('related_products');
        Schema::drop('reviews');
    }

}
