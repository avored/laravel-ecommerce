<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Property;

class PropertyTest extends BaseTestCase
{
    /**
     * @todo do one test for dropdown option too with selec as field type
     * Test to check if property resource route is working
     *
     * @return void
     */
    public function testPropertyRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.property.index'));
        $response->assertStatus(200);
        $response->assertSee('Property List');

        $response = $this->get(route('admin.property.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Property');

        $data = $this->_getDummyData();
        $response = $this->post(route('admin.property.store'), $data);
        $response->assertRedirect(route('admin.property.index'));

        $model = Property::whereIdentifier('test-property-identifier')->first();

        $response = $this->get(route('admin.property.edit', $model->id));
        $response->assertStatus(200);

        $updateData = $this->_getDummyData(['name' => 'updated property name']);

        $response = $this->put(route('admin.property.update', $model->id), $updateData);

        $response->assertRedirect(route('admin.property.index'));

        $this->delete(route('admin.property.destroy', $model->id));
        $response->assertRedirect(route('admin.property.index'));
    }

    private function _getDummyData($updateData = null)
    {
        $data['name'] = 'property name test';
        $data['identifier'] = 'test-property-identifier';
        $data['use_for_all_products'] = 0;
        $data['data_type'] = 'VARCHAR';
        $data['field_type'] = 'TEXT';
        $data['sort_order'] = 10;

        if (null != $updateData) {
            $data = array_merge($data, $updateData);
        }

        return $data;
    }
}
