<?php

use AvoRed\Ecommerce\Models\Database\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AvoRed\Ecommerce\Models\Database\Configuration;
use AvoRed\Ecommerce\Models\Database\Country;
use AvoRed\Ecommerce\Models\Database\TaxRule;

class AvoredEcommerceSchema extends Migration
{

    /**
     * @todo arrange Database Table Creation and foreign keys
     * Install the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_super_admin')->nullable();
            $table->integer('role_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('language')->nullable()->default('en');
            $table->string('image_path')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', ['GUEST', 'LIVE'])->default('LIVE');
            $table->string('activation_token')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['SHIPPING', 'BILLING']);
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('address1')->nullable()->default(null);
            $table->string('address2')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->integer('country_id')->unsigned()->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id');
            $table->integer('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id')->index()->nullable();
            $table->integer('client_id');
            $table->string('name')->nullable();
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('access_token_id', 100)->index();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->nullable();
            $table->string('name');
            $table->string('secret', 100);
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();

        });

        Schema::create('oauth_personal_access_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(NULL);
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['BASIC','VARIATION','DOWNLOADABLE','VARIABLE_PRODUCT'])->default('BASIC');


            $table->string('name')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->tinyInteger('in_stock')->nullable()->default(null);
            $table->tinyInteger('track_stock')->nullable()->default(null);
            $table->decimal('qty', 10, 6)->nullable();
            $table->tinyInteger('is_taxable')->nullable()->default(null);

            $table->float('weight')->nullable()->default(null);
            $table->float('width')->nullable()->default(null);
            $table->float('height')->nullable()->default(null);
            $table->float('length')->nullable()->default(null);


            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->decimal('price', 10, 6);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('user_viewed_products', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->text('path');
            $table->boolean('is_main_image')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_default')->default(false);
            $table->timestamps();
        });

        OrderStatus::insert([
            ['name' => 'Pending', 'is_default' => 1],
            ['name' => 'Delivered', 'is_default' => 0],
            ['name' => 'Received', 'is_default' => 0],
            ['name' => 'Canceled', 'is_default' => 0],
        ]);

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_address_id')->unsigned();
            $table->integer('billing_address_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('shipping_option');
            $table->string('payment_option');
            $table->integer('order_status_id')->unsigned();
            $table->timestamps();

            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('billing_address_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('qty');
            $table->decimal('price', 11, 6);
            $table->decimal('tax_amount', 11, 6);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('gift_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->float('discount', 6, 2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['ENABLED', 'DISABLED']);
            $table->timestamps();
        });

        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('configuration_key')->nullable()->default(null);
            $table->string('configuration_value')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->string('email')->unique()->nullable();

            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('content');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('related_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('related_product_id')->unsigned();
            $table->timestamps();

            $table->foreign('related_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->float('star');
            $table->string('comment');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('DISABLED');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address', 15);
            $table->string('url' );
            $table->string('agent', 150);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('tax_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->integer('country_id')->nullable()->unsigned();
            $table->string('state_code')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('post_code')->nullable()->default(null);
            $table->float('percentage', 8, 6)->nullable()->default(null);
            $table->integer('priority')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('code');
            $table->string('name');
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
        });

        Schema::create('tax_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('tax_group_tax_rule_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tax_rule_id')->unsigned();
            $table->integer('tax_group_id')->unsigned();
            $table->timestamps();

            $table->foreign('tax_rule_id')
                ->references('id')->on('tax_rules')
                ->onDelete('cascade');

            $table->foreign('tax_group_id')
                ->references('id')->on('tax_groups')
                ->onDelete('cascade');

        });

        Schema::create('properties', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            $table->enum('data_type',['INTEGER','DECIMAL','DATETIME','VARCHAR','BOOLEAN','TEXT'])->nullable()->default(null);
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME','CHECKBOX','RADIO','SWITCH']);
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('property_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
        });

        Schema::create('product_property_varchar_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_datetime_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamp('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_integer_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_decimal_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_text_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->text('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_property_boolean_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->tinyInteger('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('attributes', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('identifier')->unique();
            //$table->enum('data_type',['INTEGER','DECIMAL','DATETIME','VARCHAR','BOOLEAN','TEXT'])->nullable()->default(null);
            //$table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME','CHECKBOX','RADIO','SWITCH']);

            //$table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('attribute_product', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');

        });

        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('product_attribute_varchar_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_attribute_datetime_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamp('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_attribute_integer_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_attribute_decimal_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_attribute_text_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->text('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_attribute_boolean_values', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->tinyInteger('value')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('attribute_id')
                ->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_variations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('variation_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();


            $table->foreign('variation_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('order_product_variations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('attribute_dropdown_option_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('attribute_dropdown_option_id')->references('id')->on('attribute_dropdown_options');
        });



        Configuration::create(['configuration_key' => 'general_site_title', 'configuration_value' => 'AvoRed Laravel Ecommerce']);
        Configuration::create(['configuration_key' => 'general_site_description', 'configuration_value' => 'AvoRed Laravel Ecommerce']);

        Configuration::create(['configuration_key' => 'general_site_description', 'configuration_value' => 'AvoRed Laravel Ecommerce']);
        $path = public_path() . '/countries.json';

        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $code => $name) {
            Country::create(['code' => $code, 'name' => $name]);
        }

        $countryModel = Country::whereCode('nz')->first();

        Configuration::create(['configuration_key' => 'avored_tax_class_default_country_for_tax_calculation',
                                'configuration_value' => $countryModel->id]);

        TaxRule::create([
            'name' => 'NZ Tax Rule',
            'country_id' => $countryModel->id,
            'state_cdoe' => '*',
            'city' => '*',
            'post_code' => '*',
            'percentage' => 15,
            'priority' => 1
        ]);


    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('oauth_personal_access_clients');
        Schema::dropIfExists('oauth_clients');
        Schema::dropIfExists('oauth_refresh_tokens');
        Schema::dropIfExists('oauth_access_tokens');
        Schema::dropIfExists('oauth_auth_codes');

        Schema::dropIfExists('admin_password_resets');
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('configurations');
        Schema::dropIfExists('gift_coupons');

        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('product_order');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('pages');

        Schema::dropIfExists('related_products');
        Schema::dropIfExists('reviews');

        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('visitors');

        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('tax_rules');

        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_prices');
        Schema::dropIfExists('products');

        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('attribute_dropdown_options');
        Schema::dropIfExists('attribute_group_attribute_pivot');
        Schema::dropIfExists('attribute_groups');
        Schema::dropIfExists('attributes');
    }

}
