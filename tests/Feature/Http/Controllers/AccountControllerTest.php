<?php
namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Models\Database\User;
use Illuminate\Support\Carbon;
use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\Models\Database\Address;

class AccountControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testMyAccountHomeRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $response = $this->actingAs($user)->get(route('my-account.home'));
        $response->assertStatus(200);
        $response->assertSee($user->first_name);
    }

    /** @test */
    public function testMyAccountEditRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $response = $this->actingAs($user)->get(route('my-account.edit'));
        $response->assertStatus(200);
        $response->assertSee('Edit Account');
    }

    /** @test */
    public function testMyAccountStoreRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        $user->first_name = 'my new first name';
        $data = $user->toArray();
        $response = $this->actingAs($user)->post(route('my-account.store', $data));
        $response->assertStatus(302);
        $response->assertRedirect(route('my-account.home'));

        $this->assertDatabaseHas('users', ['first_name' => 'my new first name']);
    }
    
    /** @test */
    public function testMyAccountChangePasswordRoute()
    {
        $user = factory(User::class)->create();
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $response = $this->actingAs($user)->get(route('my-account.change-password'));
        $response->assertStatus(200);
        $response->assertSee('Change Password');
    }
    /** @test */
    public function testMyAccountChangePasswordPostRoute()
    {
        $user = factory(User::class)->create(['password' => bcrypt('testpassword')]);
        $user->email_verified_at = Carbon::now();
        $user->update();
        
        $data = [
            'current_password' => 'testpassword',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ];
        $response = $this->actingAs($user)->post(route('my-account.change-password.post'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('my-account.home'));
    }
}
