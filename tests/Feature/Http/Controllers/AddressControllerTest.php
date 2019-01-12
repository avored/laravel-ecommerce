<?php
namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Models\Database\User;
use Illuminate\Support\Carbon;
use AvoRed\Framework\Models\Database\Country;

class AddressControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testAddressIndexRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $response = $this->actingAs($user)->get(route('my-account.address.index'));
        $response->assertStatus(200);
        $response->assertSee('My Address');
    }

    /** @test */
    public function testAddressCreateRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $response = $this->actingAs($user)->get(route('my-account.address.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Address');
    }

    /** @test */
    public function testAddressStoreRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $country = Country::first();

        
        $data = [
            'first_name' => 'test first name',
            'last_name' => 'test last name',
            'address1' => 'test address1',
            'address2' => 'test address2',
            'city' => 'test city',
            'state' => 'test state',
            'country_id' => $country->id,
            'postcode' => 1234,
            'phone' => 1234,
            'type' => 'SHIPPING',
        ];
        $response = $this->actingAs($user)->post(route('my-account.address.store', $data));
        $response->assertStatus(302);
        $response->assertRedirect(route('my-account.address.index'));
    }
}
