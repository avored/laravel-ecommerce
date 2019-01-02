<?php
namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Models\Database\User;
use Illuminate\Support\Facades\Password;
use AvoRed\Framework\Models\Repository\ConfigurationRepository;

class AuthControllerTest extends TestCase
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

    /** @test */
    public function testRegisterPostRoute()
    {
        $data = [
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@test.com',
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
        ];
        $response = $this->post(route('register.post'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('my-account.home'));
        
        $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
    }

    /** @test */
    public function testForgetPasswordGetRoute()
    {
        $response = $this->get(route('password.reset.form'));
        $response->assertStatus(200);
        $response->assertSee('name="email"');
    }

    /** @test */
    public function testPasswordEmailPostRoute()
    {
        $user = factory(User::class)->create();
        $response = $this->post(route('password.email'), ['email' => $user->email]);
        $response->assertStatus(302);
        $response->assertSessionHas('status', 'We have e-mailed your password reset link!');
    }

    /** @test */
    public function testPasswordResetToeknGetRoute()
    {
        $response = $this->get(route('password.reset.token', str_random()));
        $response->assertStatus(200);
        $response->assertSee('Reset Password');
        $response->assertSee('name="email"');
        $response->assertSee('name="password"');
        $response->assertSee('name="password_confirmation"');
    }

    /** @test */
    public function testPasswordResetToeknPostRoute()
    {
        $user = factory(User::class)->create();

        $token = Password::broker()->createToken($user);

        $data = [
            'email' => $user->email,
            'password' => 'admin123',
            'token' => $token,
            'password_confirmation' => 'admin123'
        ];
        $response = $this->post(route('password.reset.token.post'), $data);
        $response->assertStatus(302);

        $response->assertRedirect(route('my-account.home'));
    }

    /** @test */
    public function testUserNeedsToVerifyEmailRoute()
    {
        $rep = app(ConfigurationRepository::class);

        $rep->setValueByKey('user_activation_required', 1);

        $user = factory(User::class)->create();
        $this->actingAs($user, 'web');
        $response = $this->get(route('my-account.home'));

        $response->assertStatus(302);
        $response->assertRedirect(route('verification.notice'));
    }
}
