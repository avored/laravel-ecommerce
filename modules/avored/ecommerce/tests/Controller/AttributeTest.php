<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Attribute;

class AttributeTest extends BaseTestCase
{
    /**
     * Test to check if attribute index route is working
     *
     * @return void
     */
    public function testAttributeRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.attribute.index'));
        $response->assertStatus(200);
        $response->assertSee('Attribute List');

        $response = $this->get(route('admin.attribute.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Attribute');

        $data['name'] = 'updated attribute name test';
        $data['identifier'] = 'test-name';
        $data['dropdown-options']['fdrthu']['display_text'] = 'test display text1';
        $data['dropdown-options']['sdtfsg']['display_text'] = 'test display text2';

        $response = $this->post(route('admin.attribute.store'), $data);
        $response->assertRedirect(route('admin.attribute.index'));

        $attributeModel = Attribute::whereIdentifier('test-name')->first();

        $response = $this->get(route('admin.attribute.edit', $attributeModel->id));
        $response->assertStatus(200);

        $updateData['name'] = 'updated attribute name test';
        $updateData['identifier'] = 'test-name';

        foreach ($attributeModel->attributeDropdownOptions as $option) {
            $updateData['dropdown-options'][$option->id]['display_text'] = 'test display text ' . $option->id;
        }

        $response = $this->put(route('admin.attribute.update', $attributeModel->id), $updateData);

        $response->assertRedirect(route('admin.attribute.index'));

        $this->delete(route('admin.attribute.destroy', $attributeModel->id));
        $response->assertRedirect(route('admin.attribute.index'));
    }
}
