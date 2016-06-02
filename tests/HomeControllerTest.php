<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

class HomeControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexAction()
    {
        $product = factory(Product::class)->create();
        $this->visit('/')
                    ->see('Mage2 Site');

        Product::destroy($product->id);
    }
}
