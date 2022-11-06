<?php

use AvoRed\Framework\Database\Models\Address;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Database\Models\Product;
use Faker\Factory;
use AvoRed\Framework\Database\Models\Country;
use AvoRed\Framework\Database\Models\Currency;
use AvoRed\Framework\Database\Models\Document;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Database\Models\OrderProduct;
use AvoRed\Framework\Database\Models\OrderStatus;

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

        // $colorAttribute = Attribute::create(
        //     ['name' => 'Color',
        //     'slug' => 'color',
        //     'display_as' => 'IMAGE']
        // );
        // $redOption = $colorAttribute->dropdownOptions()->create(['display_text' => 'Red', 'path' => 'uploads/catalog/attributes/red-attribute.jpg']);
        // $blueOption = $colorAttribute->dropdownOptions()->create(['display_text' => 'Blue', 'path' => 'uploads/catalog/attributes/blue-attribute.png']);
        // $yellowOption = $colorAttribute->dropdownOptions()->create(['display_text' => 'Yellow', 'path' => 'uploads/catalog/attributes/yellow-attribute.png']);


        // $brandProperty = Property::create(
        //     ['name' => 'Brand',
        //     'slug' => 'brand',
        //     'data_type' => 'INTEGER',
        //     'field_type' => 'SELECT',
        //     'use_for_all_products' => 1,
        //     'use_for_category_filter' => 1,
        //     'is_visible_frontend' => 1,
        //     'sort_order' => 10]
        // );
        // $avoredOption = $brandProperty->dropdownOptions()->create(['display_text' => 'Avored']);
        // $phpOption = $brandProperty->dropdownOptions()->create(['display_text' => 'PHP']);
        // $laravelOption = $brandProperty->dropdownOptions()->create(['display_text' => 'Laravel']);

        // $materialProperty = Property::create(
        //     ['name' => 'Frame Material',
        //     'slug' => 'frame-material',
        //     'data_type' => 'INTEGER',
        //     'field_type' => 'SELECT',
        //     'use_for_all_products' => 1,
        //     'use_for_category_filter' => 1,
        //     'is_visible_frontend' => 1,
        //     'sort_order' => 10]
        // );
        // $oakwoodOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Oak wood']);
        // $whiteWoodOption = $materialProperty->dropdownOptions()->create(['display_text' => 'White wood framae']);
        // $aluminumFrameOption = $materialProperty->dropdownOptions()->create(['display_text' => 'Aluminium frame']);

        // CategoryFilter::create(
        //     ['category_id' => $avoredCategory->id,
        //     'filter_id' => $brandProperty->id,
        //     'type' => 'PROPERTY']
        // );
        // CategoryFilter::create(
        //     ['category_id' => $phpCategory->id,
        //     'filter_id' => $brandProperty->id,
        //     'type' => 'PROPERTY']
        // );
        // CategoryFilter::create(
        //     ['category_id' => $laravelCategory->id,
        //     'filter_id' => $brandProperty->id,
        //     'type' => 'PROPERTY']
        // );
        // CategoryFilter::create(
        //     ['category_id' => $avoredCategory->id,
        //     'filter_id' => $materialProperty->id,
        //     'type' => 'PROPERTY']
        // );
        // CategoryFilter::create(
        //     ['category_id' => $phpCategory->id,
        //     'filter_id' => $materialProperty->id,
        //     'type' => 'PROPERTY']
        // );
        // CategoryFilter::create(
        //     ['category_id' => $laravelCategory->id,
        //     'filter_id' => $materialProperty->id,
        //     'type' => 'PROPERTY']
        // );

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
        Document::create([
            'path' => 'uploads/catalog/avored-sofa-set.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/avored-sofa-set.jpg'),
            'origional_name' => 'avored-sofa-set.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $aluminumFrameOption->id]);
        // $product->properties()->sync([$brandProperty->id, $materialProperty->id]);

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
        Document::create([
            'path' => 'uploads/catalog/avored-single-bed.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/avored-single-bed.jpg'),
            'origional_name' => 'avored-single-bed.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-single-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $whiteWoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/avored-double-bed.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/avored-double-bed.jpg'),
            'origional_name' => 'avored-double-bed.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-double-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/avored-queen-bed.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/avored-queen-bed.jpg'),
            'origional_name' => 'avored-queen-bed.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-queen-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/avored-bunk-bed.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/avored-bunk-bed.jpg'),
            'origional_name' => 'avored-bunk-bed.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/avored-bunk-bed.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $avoredOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $whiteWoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/php-sofa-set.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/php-sofa-set.jpg'),
            'origional_name' => 'php-sofa-set.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/php-sofa-set.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $phpOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $whiteWoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/laravel-sofa-set.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/laravel-sofa-set.jpg'),
            'origional_name' => 'laravel-sofa-set.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/laravel-sofa-set.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $laravelOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/php-single-mattress.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/php-single-mattress.jpg'),
            'origional_name' => 'php-single-mattress.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/php-single-mattress.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $phpOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $oakwoodOption->id]);


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
        Document::create([
            'path' => 'uploads/catalog/laravel-bedside-table.jpg',
            'mime_type' => 'image/jpg',
            'size' => filesize(__DIR__ . '/../../assets/uploads/catalog/laravel-bedside-table.jpg'),
            'origional_name' => 'laravel-bed-sidetable.jpg',
            'documentable_type' => Product::class,
            'documentable_id' => $product->id
        ]);

        OrderStatus::create([
            'name' => 'Pending',
            'is_default' => 1
        ]);
        OrderStatus::create([
            'name' => 'Processing',
            'is_default' => 0
        ]);
        OrderStatus::create([
            'name' => 'Complete',
            'is_default' => 0
        ]);
        // $product->properties()->sync($brandProperty);
        // $product->properties()->sync($materialProperty);

        // ProductImage::create(['path' => 'uploads/catalog/'. $product->id .'/laravel-bedside-table.jpg', 'product_id' => $product->id, 'is_main_image' => 1]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $brandProperty->id, 'value' => $laravelOption->id]);
        // $product->productPropertyIntegerValues()->create(['property_id' => $materialProperty->id, 'value' => $aluminumFrameOption->id]);

        // $mainMenu = MenuGroup::create(['name' => 'Main Menu', 'identifier' => 'main-menu', 'is_default' => 1]);

        // $mainMenu->menus()->create(['name' => $avoredCategory->name, 'type' => Menu::CATEGORY, 'route_info' => $avoredCategory->slug]);
        // $mainMenu->menus()->create(['name' => $phpCategory->name, 'type' => Menu::CATEGORY, 'route_info' => $phpCategory->slug]);
        // $mainMenu->menus()->create(['name' => $laravelCategory->name, 'type' => Menu::CATEGORY, 'route_info' => $laravelCategory->slug]);
        // $mainMenu->menus()->create(['name' => 'Cart', 'type' => Menu::FRONT_MENU, 'route_info' => 'cart.show']);
        // $mainMenu->menus()->create(['name' => 'Checkout', 'type' => Menu::FRONT_MENU, 'route_info' => 'checkout.show']);
        // $mainMenu->menus()->create(['name' => 'Login', 'type' => Menu::FRONT_MENU, 'route_info' => 'login']);
        // $mainMenu->menus()->create(['name' => 'Register', 'type' => Menu::FRONT_MENU, 'route_info' => 'register']);

        // $mainAuthMenu = MenuGroup::create(['name' => 'Main Auth Menu', 'identifier' => 'main-auth-menu']);

        // $mainAuthMenu->menus()->create(['name' => $avoredCategory->name, 'type' => Menu::CATEGORY, 'route_info' => $avoredCategory->slug]);
        // $mainAuthMenu->menus()->create(['name' => $phpCategory->name, 'type' => Menu::CATEGORY, 'route_info' => $phpCategory->slug]);
        // $mainAuthMenu->menus()->create(['name' => $laravelCategory->name, 'type' => Menu::CATEGORY, 'route_info' => $laravelCategory->slug]);
        // $mainAuthMenu->menus()->create(['name' => 'Cart', 'type' => Menu::FRONT_MENU, 'route_info' => 'cart.show']);
        // $mainAuthMenu->menus()->create(['name' => 'Checkout', 'type' => Menu::FRONT_MENU, 'route_info' => 'checkout.show']);
        // $accountMenu = $mainAuthMenu->menus()->create(['name' => 'Account', 'type' => Menu::FRONT_MENU, 'route_info' => 'account.dashboard']);
        // $mainAuthMenu->menus()->create(['name' => 'Logout', 'type' => Menu::FRONT_MENU, 'route_info' => 'logout', 'parent_id' => $accountMenu->id]);

        // Page::create(
        //     ['name' => 'HomePage',
        //     'slug' => 'home-page',
        //     'content' => '%%%avored-banner%%%']
        // );

        // $customer = Customer::create([
        //     'first_name' => $faker->firstName(),
        //     'last_name' => $faker->lastName(),
        //     'email' => $faker->safeEmail(),
        //     'password' => 'secret',
        // ]);

        // $this->createOrder($faker, $customer);
        // $this->createOrder($faker, $customer);
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

    public function createOrder($faker, $customer)
    {
        $shippingAddress = $customer->addresses()->create([
            'type' => Address::SHIPPING,
            'company_name' => $faker->company,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'address1' => $faker->streetAddress,
            'address2' => $faker->streetSuffix,
            'postcode' => $faker->postcode,
            'city' => $faker->city,
            'state' => $faker->state,
            'country_id' => Country::all()->random(1)->first()->id,
            'phone' => $faker->phoneNumber,
        ]);
        $billingAddress = $customer->addresses()->create([
            'type' => Address::BILLING,
            'company_name' => $faker->company,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'address1' => $faker->streetAddress,
            'address2' => $faker->streetSuffix,
            'postcode' => $faker->postcode,
            'city' => $faker->city,
            'state' => $faker->state,
            'country_id' => Country::all()->random(1)->first()->id,
            'phone' => $faker->phoneNumber,
        ]);

        $orderData = [
            'shipping_option' => 'pickup',
            'payment_option' => 'a-cash-on-delivery',
            'order_status_id' => OrderStatus::whereIsDefault(1)->first()->id,
            'currency_id' => Currency::all()->first()->id,
            'customer_id' => $customer->id,
            'shipping_address_id' => $shippingAddress->id,
            'billing_address_id' => $billingAddress->id,
        ];
        $order = Order::create($orderData);

        $qty = rand(1, 10);
        $product = Product::all()->random(1)->first();
        $orderProductData = [
            'product_id' => $product->id,
            'order_id' => $order->id,
            'qty' => $qty,
            'price' => $product->price,
            'tax_amount' => 0,
        ];

        OrderProduct::create($orderProductData);

    }
}
