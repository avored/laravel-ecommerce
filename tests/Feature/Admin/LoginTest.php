<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
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
        $response->assertSee('AvoRed Admin Login');
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
