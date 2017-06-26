<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminLoginTest extends TestCase
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
        $email = 'admin@admin.com';
        $password = 'admin123';

        $response = $this->post('/admin/login', ['email' => $email, 'password' => $password]);

        $response->assertRedirect('/admin');
    }
}
