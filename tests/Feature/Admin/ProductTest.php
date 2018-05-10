<?php

namespace Tests\Feature\Admin;

use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Database\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic Product Index Route.
     *
     * @return void
     */
    public function testProductIndex()
    {
        $response = $this->actingAs($this->adminUser,'admin')->get('/admin/product');
        $response->assertSee('Product List');
    }

    /**
     * Admin Product Create Route.
     *
     * @return void
     */
    public function testProductCreate()
    {
        $response = $this->actingAs($this->adminUser,'admin')->get('/admin/product/create');
        $response->assertSee('Create Product');
    }


    /**
     * Admin Product Create Route.
     *
     * @return void
     */
    public function testProductPost()
    {
        $response = $this->actingAs($this->adminUser,'admin')
                            ->post('/admin/product', ['name' => 'Test Product Name',
                                                        'type' => 'BASIC']);


        $response->assertStatus(302);
        //$response->assertSee('Test Product Name');
        //$this->assertDatabaseHas('products',['name' => 'Test Product Name']);

    }

    /**
     * Admin Product Edit Route.
     *
     * @return void
     */
    public function testProductEdit()
    {

        $product = Product::create(['name' => 'Test Product', 'type' => 'BASIC']);
        $response = $this->actingAs($this->adminUser,'admin')
                                            ->put("/admin/product/{$product->id}/edit");

        $response->assertSee('Test Product')
                ->assertStatus(200);

    }

    /**
     * Admin Product Update Route.
     *
     * @return void
     */
    public function testProductUpdate()
    {

        $category = Category::create(['name' => 'Test Category', 'slug' => 'test-category']);
        $product = Product::create(['name' => 'Test Product', 'type' => 'BASIC']);

        $response = $this->actingAs($this->adminUser,'admin')
                                ->put("/admin/product/{$product->id}", ['name' => 'Test Product Update',
                                                                    'sku' => 'test-product-update',
                                                                    'category_id' => [$category->id],
                                                                    'price' => 10.00,
                                                                    'description' => 'test description',
                                                                    'qty' => 10,
                                                                    'status' => 1,
                                                                    'in_stock' => 1,
                                                                    'track_stock' => 1,
                                                                    'is_taxable' => 1
                                                                    ]);

        $response->assertRedirect('/admin/product')
                                ->assertStatus(302);;
        $this->assertDatabaseHas('products',['sku' => 'test-product-update','name' => 'Test Product Update']);
        $this->assertDatabaseHas('product_prices',['product_id' => $product->id,'price' => 10.00]);
        $this->assertDatabaseHas('category_product',['product_id' => $product->id,'category_id' => $category->id]);

    }



    /**
     * Admin Product Destroy Route.
     *
     * @return void
     */
    public function testProductDestroy()
    {


        $product = Product::create(['name' => 'Test Product', 'type' => 'BASIC']);

        $response = $this->actingAs($this->adminUser,'admin')
                                    ->delete("/admin/product/{$product->id}");

        $response->assertRedirect('/admin/product')
                    ->assertStatus(302);
        $this->assertDatabaseMissing('products',['slug' => $product->slug]);

    }


    /**
     * Admin Product Destroy Route.
     *
     * @return void
     */
    public function testUploadFile()
    {
        
        $this->assertTrue(true);

    }


}