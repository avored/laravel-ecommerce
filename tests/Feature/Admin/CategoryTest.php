<?php

namespace Tests\Feature\Admin;

use AvoRed\Framework\Models\Database\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic Category Index Route.
     *
     * @return void
     */
    public function testCategoryIndex()
    {
        $response = $this->actingAs($this->adminUser,'admin')->get('/admin/category');
        $response->assertSee('Category List');
    }

    /**
     * Admin Category Create Route.
     *
     * @return void
     */
    public function testCategoryCreate()
    {
        $response = $this->actingAs($this->adminUser,'admin')->get('/admin/category/create');
        $response->assertSee('Create Category');
    }


    /**
     * Admin Category Create Route.
     *
     * @return void
     */
    public function testCategoryPost()
    {
        $response = $this->actingAs($this->adminUser,'admin')
                            ->post('/admin/category', ['name' => 'Test Category Name',
                                                        'slug' => 'test-category-name']);

        $response->assertRedirect('/admin/category');
        $this->assertDatabaseHas('categories',['slug' => 'test-category-name']);

    }

    /**
     * Admin Category Edit Route.
     *
     * @return void
     */
    public function testCategoryEdit()
    {

        $category = Category::create(['name' => 'Test Category', 'slug' => 'test-category']);
        $response = $this->actingAs($this->adminUser,'admin')
                                            ->put("/admin/category/{$category->id}/edit");

        $response->assertSee('Test Category')
                ->assertSee('test-category');

    }

    /**
     * Admin Category Update Route.
     *
     * @return void
     */
    public function testCategoryUpdate()
    {

        $category = Category::create(['name' => 'Test Category', 'slug' => 'test-category']);
        $response = $this->actingAs($this->adminUser,'admin')
                                ->put("/admin/category/{$category->id}", ['name' => 'Test Category Update',
                                                                                'slug' => 'test-category-update']);

        $response->assertRedirect('/admin/category');
        $this->assertDatabaseHas('categories',['slug' => 'test-category-update']);

    }



    /**
     * Admin Category Destroy Route.
     *
     * @return void
     */
    public function testCategoryDestroy()
    {

        $category = Category::create(['name' => 'Test Category', 'slug' => 'test-category']);

        $response = $this->actingAs($this->adminUser,'admin')
                                    ->delete("/admin/category/{$category->id}");

        $response->assertRedirect('/admin/category');
        $this->assertDatabaseMissing('categories',['slug' => 'test-category-update']);

    }
}