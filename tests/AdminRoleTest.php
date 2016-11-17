<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminRoleTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminRoleList() {
        $this->adminUserLogin();
        $this->visit('/admin/role')
                ->see('Role List')
                ->see('Administrator')
        ;
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminRoleCreate() {
        $this->adminUserLogin();
        $this->visit('/admin/role/create')
                ->see('Create Role')
                ->type('Editor','name')
                ->type('editor description','description')
                //->check('permissions[admin.category.index]')
                //->check('permissions[admin.category.create,admin.category.store]')
                //->check('permissions[admin.category.edit,admin.category.update]')
                //->check('permissions[admin.category.destroy]')
                ->press('Create Role')
                ->seePageIs('/admin/role')
                ->see('Editor')
        ;
    }

    

}
