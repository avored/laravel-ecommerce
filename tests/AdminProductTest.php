<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mage2\Catalog\Models\Category;
use Mage2\Install\Models\Website;

class AdminProductTest extends TestCase
{
    /**
     * A basic admin product index route test.
     *
     * @return void
     */
    public function testAdminProductIndex()
    {
        $this->adminUserLogin();
        $this->visit('/admin/product')->see('Product List');
    }
    /**
     * A basic admin product create route test.
     *
     * @return void
     */
    public function testAdminProductCreate()
    {
        $this->adminUserLogin();
        $this->visit('/admin/product/create')->see('Create Product');
    }

    /**
     * A basic admin product store route test.
     *
     * @return void
     */
    public function testAdminProductStore()
    {
        $this->adminUserLogin();

        /**
        $website = Website::first();

        $category = Category::create(['name' => 'category',
                                    'slug' => 'category-slug',
                                    'parent_id' => 0,
                                    'website_id' => $website->id
                                ]);

        $title = str_random();
        $slug = str_slug($title);
        $data = [
            'title' => $title,
            'slug' => $slug,
            'sku' => $slug,
            'description' => 'Product Description test',
            'price' => 10.99,
            'status' => 1,
            'is_featured' => 1,
            'category_id' => [$category->id],
            'website_id' => [$website->id],
            'image' => [],
            'in_stock' => 1,
            'track_stock' =>1,
            'qty' =>10,
            'is_taxable' =>1,

        ];

        $this->route('post','admin.product.store',$data);

        $this->seeInDatabase('product_varchar_values',['value' =>  $title]);
        $category->delete();

         *
         */


    }
}
