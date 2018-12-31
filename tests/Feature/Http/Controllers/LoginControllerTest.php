<?php
namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testLoginRoute()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('name="email"');
        $response->assertSee('name="password"');
    }
    /** @test */
    public function testRegisterRoute()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
        $response->assertSee('name="first_name"');
        $response->assertSee('name="last_name"');
        $response->assertSee('name="email"');
        $response->assertSee('name="password"');
        $response->assertSee('name="password_confirmation"');
    }
}
