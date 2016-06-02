<?php

use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartControllerTest extends TestCase
{
    /**
     * A basic test for cart index and add to cart action.
     *
     * @return void
     */
    public function testIndexAction()
    {
        $product = factory(App\Product::class)->create();
        
        $this->visit('/product/'. $product->id)->click('Add To Cart');
        $this->visit('/cart')->see($product->title)->see($product->price);
        Product::destroy($product->id);
    }
    /**
     * A basic test for cart index and add to cart action.
     *
     * @return void
     */
    public function testRepeatAddToCartAction()
    {
        $product = factory(App\Product::class)->create();
        
        $this->visit('/product/'. $product->id)->click('Add To Cart');
        $this->visit('/product/'. $product->id)->click('Add To Cart');
        $this->visit('/cart')->seeInField('qty',2);
        Product::destroy($product->id);
    }

    /**
     * A basic test for cart index and add to cart action.
     *
     * @return void
     */
    public function testUpdateCartAction()
    {
        $product = factory(App\Product::class)->create();

        $this->visit('/product/'. $product->id)->click('Add To Cart');
        $this->visit('/cart')->type(2,'qty')->press('update');
        $this->visit('/cart')->seeInField('qty',2);
        Product::destroy($product->id);
    }

    /**
     * A basic test for cart index and add to cart action.
     *
     * @return void
     */
    public function testDeleteCartAction()
    {
        $product = factory(App\Product::class)->create();

        $this->visit('/product/'. $product->id)->click('Add To Cart');
        $this->visit('/cart')->press('delete');
        $this->visit('/cart')->dontSee($product->title);
        Product::destroy($product->id);
    }
}
