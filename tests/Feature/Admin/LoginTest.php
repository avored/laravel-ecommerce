<?php

namespace Tests\Feature\Admin;

use Mage2\Ecommerce\Models\Database\AdminUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
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
        $response = $this->post('/admin/login', ['email' => $this->adminUser->email, 'password' => $this->adminUserPassword]);

        //$this->assertDatabaseHas('admin_users',['email' => $this->adminUser->email]);
        $response->assertRedirect('/admin');
    }
}
