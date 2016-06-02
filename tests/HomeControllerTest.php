<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexAction()
    {
        $product = factory(App\Product::class)->create();
        $this->visit('/')
                    ->see($product->title)
                    ->see($product->price);
    }
}
