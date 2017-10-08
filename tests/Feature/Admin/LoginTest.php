<?php

namespace Tests\Feature\Admin;

use Mage2\Ecommerce\Models\Database\AdminUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic login example.
     *
     * @return void
     */
    public function testLoginGet()
    {
        $response = $this->get('/admin/login');
        $response->assertSee('Mage2 Admin Login');
    }

    /**
     * A basic login post.
     *
     * @return void
     */
    public function testLoginPost()
    {
        $password = 'admin123';
        $email = $this->faker->email;
        $user = AdminUser::create(['first_name' => 'Test Name','last_name' => 'Last Name','email' => $email,'password' => bcrypt($password),'role_id' => 1]);

        $response = $this->post('/admin/login', ['email' => $user->email, 'password' => $password]);

        $response->assertRedirect('/admin');
    }
}
