<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Ecommerce\Models\Database\AdminUser;

class AdminUserTest extends BaseTestCase
{
    /**
     * Test to check if admin user index route is working
     *
     * @return void
     */
    public function testAdminUserRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.admin-user.index'));
        $response->assertStatus(200);
        $response->assertSee('Admin User List');

        $response = $this->get(route('admin.admin-user.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Admin User');

        $response = $this
                        ->post(
                            route('admin.admin-user.store'),
                                        [
                                            'first_name' => 'test',
                                            'last_name' => 'test',
                                            'email' => 'admin@test.com',
                                            'password' => 'admin123',
                                            'password_confirmation' => 'admin123',
                                            'role_id' => $user->role_id
                                        ]
                        );
        $response->assertRedirect(route('admin.admin-user.index'));

        $adminTestUser = AdminUser::whereEmail('admin@test.com')->first();

        $response = $this->put(
                            route('admin.admin-user.update', $adminTestUser->id),
                            [
                                'first_name' => 'test new name',
                                'last_name' => 'test',
                                'email' => 'admin@test.com',
                                'role_id' => $user->role_id
                            ]
                        );

        $response->assertRedirect(route('admin.admin-user.index'));

        $this->delete(route('admin.admin-user.destroy', $adminTestUser->id));
        $response->assertRedirect(route('admin.admin-user.index'));
    }
}
