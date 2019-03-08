<?php
namespace Tests\Feature\Http\Controllers;

use AvoRed\Framework\Models\Database\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCategoryViewRoute()
    {
        $category = factory(Category::class)->create();
        $response = $this->get(route('category.view', $category->slug));
        $response->assertStatus(200);
    }
}
