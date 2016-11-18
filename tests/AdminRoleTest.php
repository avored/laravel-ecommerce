<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mage2\User\Models\Role;

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
        $roleName = str_random();
        $this->visit('/admin/role/create')
                ->see('Create Role')
                ->type($roleName,'name')
                ->type('editor description','description')

                ->press('Create Role')
                ->seePageIs('/admin/role')
                ->see($roleName)
        ;
        //Delete created role
        Role::all()->last()->delete();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminRoleEdit() {
        $this->adminUserLogin();


        $role = $this->_creteRole();


        $this->visit('/admin/role/' . $role->id. '/edit')
            ->see('Edit Role')
            ->seeInField('name',$role->name)
                ->type('abc test name','name')
                ->press('Update Role')
                ->seePageIs('/admin/role')
                ->see('abc test name')
        ;

        $this->_deleteRole($role->id);
    }


    public function testAdminRoleDestroy() {
        $this->adminUserLogin();

        $role = $this->_creteRole();
        $this->visit('/admin/role')->see($role->name);
        $this->makeRequest('delete', '/admin/role/' . $role->id)
                ->seePageIs('/admin/role')
                ->dontSee($role->name);
        //$this->_deleteRole($role->id);
    }

    private function _creteRole() {
        $role = Role::create(['name' => str_random(),  'description' => 'some description']);
        return $role;
    }


    private function _deleteRole($id) {
        Role::destroy($id);
    }
    

}
