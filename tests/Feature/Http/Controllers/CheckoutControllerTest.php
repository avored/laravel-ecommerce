<?php
namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;


    /** @test */
    public function testCheckoutViewRoute()
    {
        $response = $this->get(route('checkout.index'));
        $response->assertStatus(200);
        $response->assertSee('Checkout');
    }
}
