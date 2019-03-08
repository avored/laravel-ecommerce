<?php
namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;


    /** @test */
    public function testProductViewRoute()
    {
        $product = factory(Product::class)->create();
        $response = $this->get(route('product.view', $product->slug));
        $response->assertStatus(200);
        $response->assertSee($product->title);
    }
}
