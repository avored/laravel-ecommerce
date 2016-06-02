<?php

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductControllerTest extends TestCase
{
    /**
     * A basic Index Action Example.
     *
     * @return void
     */
    public function testIndexAction()
    {
        $user = factory(User::class,1)->create(['password' => bcrypt('admin123')]);

        $product = factory(Product::class,1)->create();
        $this->actingAs($user)
                ->visit('/admin/product')
                ->see('Products');
        User::where('email', '=', $user->email)->delete();
        Product::where('title', '=', $product->title)->delete();
    }

    /**
     * A basic Create and Store Action Example.
     *
     * @return void
     */
    public function testCreateAction()
    {
        $user = factory(User::class,1)->create(['password' => bcrypt('admin123')]);

        //$product = factory(Product::class,1)->create();
        $this->actingAs($user)
            ->visit('/admin/product/create')
            ->see('Create Products')
            ->type('Product1', 'title')
            ->type(12.99, 'price')
            ->press('create')
            ->seePageIs('/admin/product')
            ->see('Product1')
            ->see(12.99);
        User::where('email', '=', $user->email)->delete();
        //Product::where('title', '=', $product->title)->delete();
    }

    /**
     * A basic Index Action Example.
     *
     * @return void
     */
    public function testUpdateAction()
    {
        $user = factory(User::class,1)->create(['password' => bcrypt('admin123')]);

        $product = factory(Product::class,1)->create();

        $this->actingAs($user)
            ->visit("/admin/product/$product->id/edit")
            ->seeInField('title', $product->title)
            ->seeInField('price', $product->price)
            ->type('Test 1', 'title')
            ->press('update')
            ->visit('/product/'. $product->id)
            ->see('Test 1');

        User::where('email', '=', $user->email)->delete();
        Product::where('title', '=', $product->title)->delete();
    }

    /**
     * A basic Index Action Example.
     *
     * @return void
     */
    public function testDeleteAction()
    {
        $user = factory(User::class,1)->create(['password' => bcrypt('admin123')]);

        $product = factory(Product::class,1)->create();

        $this->actingAs($user)
            ->call('DELETE',"/admin/product/" . $product->id, ['_token' => csrf_token()])
            ;
        $this->assertRedirectedTo('/admin/product');
        $this->followRedirects();

        //$this->visit('/product/'. $product->id)->assertResponseStatus(404);
        //$this->assertResponseStatus(404);

        User::where('email', '=', $user->email)->delete();
        Product::where('title', '=', $product->title)->delete();
    }

}
