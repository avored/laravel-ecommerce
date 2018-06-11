<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Ecommerce\Models\Database\AdminUser;
use AvoRed\Ecommerce\Models\Database\Role;

class LoginTest extends BaseTestCase
{
    /**
     * Test to check if admin login get controller is working
     *
     * @return void
     */
    public function testLoginGetTest()
    {
        $response = $this->get('login');
        $response->assertStatus(200);
        $response->assertSee('AvoRed Admin Login');
    }

    /**
     * Test to check if admin login get controller is working
     *
     * @return void
     */
    public function testLoginPostTest()
    {
        $role = Role::create(['name' => 'Administrator','description' => 'Administrator']);
        $user = AdminUser::create(['role_id' => $role->id,
                                'is_super_admin' => 1,
                                'first_name' => 'Purvesh',
                                'last_name' => 'Patel',
                                'email' => 'admin@admin.com',
                                 'password' => bcrypt('admin123')
                            ]);

        $response = $this->post('login', ['email' => 'admin@admin.com', 'password' => 'admin123']);
        $response->assertRedirect('admin');

    }
}
