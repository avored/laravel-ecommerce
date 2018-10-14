<?php

namespace Tests\Feature\Admin;

use AvoRed\Framework\Models\Database\Attribute;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic Attribute Index Route.
     *
     * @return void
     */
    public function testAttributeIndex()
    {
        $response = $this->actingAs($this->adminUser,'admin')->get('/admin/attribute');
        $response->assertSee('Attribute List');
    }

    /**
     * Admin Attribute Create Route.
     *
     * @return void
     */
    public function testAttributeCreate()
    {
        $response = $this->actingAs($this->adminUser,'admin')->get('/admin/attribute/create');
        $response->assertSee('Create Attribute');
    }


    /**
     * Admin Attribute Create Route.
     *
     * @return void
     */
    public function testAttributePost()
    {
        $data = $this->_getAttributeBasicData();  
        $response = $this->actingAs($this->adminUser,'admin')
                            ->post('/admin/attribute', $data);

        $response->assertRedirect('/admin/attribute');
        $this->assertDatabaseHas('attributes',['identifier' => 'test-attribute']);
        $this->assertDatabaseHas('attribute_dropdown_options',['display_text' => 'test option1']);

    }

    /**
     * Admin Attribute Edit Route.
     *
     * @return void
     */
    public function testAttributeEdit()
    {

        $data = $this->_getAttributeBasicData();
        $attribute = Attribute::create($data);
        $response = $this->actingAs($this->adminUser,'admin')
                                            ->put("/admin/attribute/{$attribute->id}/edit");

        $response->assertSee('Test Attribute')
                ->assertSee('test-attribute')
                ->assertSee('test option1');


    }

    /**
     * Admin Attribute Update Route.
     *
     * @return void
     */
    public function testAttributeUpdate()
    {

        $data = $this->_getAttributeBasicData();
        $attribute = Attribute::create($data);

        $data['name'] = 'Test Attribute Update';
        $data['identifier'] = 'test-attribute-update';

        $response = $this->actingAs($this->adminUser,'admin')
                                ->put("/admin/attribute/{$attribute->id}", $data);

        $response->assertRedirect('/admin/attribute');
        $this->assertDatabaseHas('attributes',['identifier' => 'test-attribute-update']);
        $this->assertDatabaseHas('attribute_dropdown_options',['display_text' => 'test option1']);
    }



    /**
     * Admin Attribute Destroy Route.
     *
     * @return void
     */
    public function testAttributeDestroy()
    {
        $data = $this->_getAttributeBasicData();
        $attribute = Attribute::create($data);

        $response = $this->actingAs($this->adminUser,'admin')
                                    ->delete("/admin/attribute/{$attribute->id}");

        $response->assertRedirect('/admin/attribute');
        $this->assertDatabaseMissing('attributes',['identifier' => 'test-attribute']);
        $this->assertDatabaseMissing('attribute_dropdown_options',['display_text' => 'test option1']);

    }

    private function _getAttributeBasicData() {
        $data = [     
            'name' => 'Test Attribute',
            'identifier' => 'test-attribute',
            'dropdown_options' => [
                str_random('6') => ['display_text' => 'test option1'],
                str_random('6') => ['display_text' => 'test option2']
            ]
        ];

        return $data;
    }
}