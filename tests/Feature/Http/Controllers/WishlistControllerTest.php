<?php
namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Models\Database\User;
use Illuminate\Support\Carbon;
use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\Models\Database\Address;
use Illuminate\Http\UploadedFile;
use AvoRed\Framework\Models\Database\Wishlist;

class WishlistControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testMyAccountwishlistAddRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $product = factory(Product::class)->create();
        $response = $this->actingAs($user)->get(route('my-account.wishlist.add', $product->slug));
        $response->assertStatus(302);
    }

    /** @test */
    public function testMyAccountwishlistRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $response = $this->actingAs($user)->get(route('my-account.wishlist.list'));
        $response->assertStatus(200);
        $response->assertSee('My Wishlist');
    }

    /** @test */
    public function testMyAccountwishlistRemoveRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $wishlist = factory(Wishlist::class)->create();
        $product = Product::find($wishlist->product_id);

        $response = $this->actingAs($user)->get(route('my-account.wishlist.remove', $product->slug));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('wishlists', ['product_id' => $product->id, 'user_id' => $user->id]);
    }
}
