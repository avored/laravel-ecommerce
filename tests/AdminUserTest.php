<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Mage2\User\Models\AdminUser;

class AdminUserTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminUserList() {
        $this->adminUserLogin();
        $this->visit('/admin/admin-user')
                ->see('Admin User List')
                ->see('test User')
        ;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminUserCreate() {
        $this->adminUserLogin();

        $adminUser = Auth::guard('admin')->user();
        $adminUserEmail = str_random() . "@gmail.com";


        $data = [
            'first_name' => 'test user first name',
            'last_name' => 'test user first name',
            'email' => $adminUserEmail,
            'password' => 'admin123',
            'password_confirmation' => 'admin123',
            'role_id' => $adminUser->role_id
        ];

        $this->route('POST', 'admin.admin-user.store', $data);

        $this->assertRedirectedToRoute('admin.admin-user.index');
        $this->seeInDatabase('admin_users', ['first_name' => 'test user first name']);

        //AdminUser::last()->delete();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminUserEdit() {
        $this->adminUserLogin();
        $adminUser = Auth::guard('admin')->user();
        $this->route('GET', 'admin.admin-user.edit', $adminUser->id);
        $this->seeInField('email', $adminUser->email);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminUserUpdate() {
        $this->adminUserLogin();
        $adminUser = Auth::guard('admin')->user();
        $data = ['first_name' => 'new updated first name', 'last_name' => 'new updated last name'];
        $this->route('PUT', 'admin.admin-user.update', $adminUser->id, $data);
        $this->seeInDatabase('admin_users', $data);
    }

    public function testAdminUserDestroy() {
        $this->adminUserLogin();

        $adminUser = $this->_creteAdminUser();
        $this->route('DELETE', 'admin.admin-user.destroy', $adminUser->id);
        $this->dontSeeInDatabase('admin_users',['id' => $adminUser->id]);
    }

    private function _creteAdminUser() {
        return AdminUser::create([
                    'first_name' => str_random(6),
                    'last_name' => str_random(6),
                    'email' => str_random(6). "@gmail.com",
                    'password' => 'admin123',
                    'password_confirmation' => 'admin123',
                    'role_id' => 1,
                ]);
    }

}
