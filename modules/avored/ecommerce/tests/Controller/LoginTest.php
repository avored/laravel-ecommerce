<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;

class LoginTest extends BaseTestCase
{
    /**
     * Test to check if admin login get controller is working
     *
     * @return void
     */
    public function testLoginGetTest()
    {
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200);
        $response->assertSee('AvoRed Admin Login');
    }

    /**
     * Test to check if admin login post route is working
     *
     * @return void
     */
    public function testLoginPostTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->post(route('admin.login.post'), ['email' => 'admin@admin.com', 'password' => 'admin123']);

        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test to check if admin logout post route
     *
     * @return void
     */
    public function testLogoutPostTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
    }
}
