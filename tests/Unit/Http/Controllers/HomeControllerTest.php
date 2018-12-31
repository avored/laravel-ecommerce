<?php
namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Database\Product;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /** @test */
    public function indexRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
