<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Ecommerce\Models\Database\Role;

class RoleTest extends BaseTestCase
{
    /**
     * @todo do one test with individual role permission for a route
     * Test to check if role resource route is working
     *
     * @return void
     */
    public function testRoleRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.role.index'));
        $response->assertStatus(200);
        $response->assertSee('Role List');

        $response = $this->get(route('admin.role.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Role');

        $data = $this->_getDummyData();
        $response = $this->post(route('admin.role.store'), $data);
        $response->assertRedirect(route('admin.role.index'));

        $model = Role::whereName('role name test')->first();

        $response = $this->get(route('admin.role.edit', $model->id));
        $response->assertStatus(200);

        $updateData = $this->_getDummyData(['name' => 'updated role name']);

        $response = $this->put(route('admin.role.update', $model->id), $updateData);

        $response->assertRedirect(route('admin.role.index'));

        $this->delete(route('admin.role.destroy', $model->id));
        $response->assertRedirect(route('admin.role.index'));
    }

    private function _getDummyData($updateData = null)
    {
        $data['name'] = 'role name test';
        $data['description'] = 'role description';

        if (null != $updateData) {
            $data = array_merge($data, $updateData);
        }

        return $data;
    }
}
