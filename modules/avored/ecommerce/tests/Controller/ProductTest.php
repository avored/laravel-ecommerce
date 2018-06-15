<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class ProductTest extends BaseTestCase
{
    /**
     * Test to check if basic product resource route is working
     *
     * @return void
     */
    public function testBasicProductRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        // Product Index Route
        $response = $this->actingAs($user, 'admin')->get(route('admin.product.index'));
        $response->assertStatus(200);
        $response->assertSee('Product List');

        // Product Create Route
        $response = $this->get(route('admin.product.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Product');

        // Product Store Route
        $data       = $this->_getBasicDummyData();
        $response   = $this->post(route('admin.product.store'), $data);
        $model      = Product::whereName('product test name')->first();
        $response->assertRedirect(route('admin.product.edit', $model->id));


        $categoryModel =  $this->_getDummyCategory();
        $data['category_id'] = [$categoryModel->id]; 
        $data['sku'] = 'test-sku'; 
        $data['description'] = 'test description'; 
        $data['price'] = 10; 
        $data['status'] = 1; 
        $data['qty'] = 10; 
        $data['in_stock'] = 1; 
        $data['track_stock'] = 1; 
        $data['is_taxable'] = 1; 
        $data['weight'] = 1; 
        $data['height'] = 1; 
        $data['width'] = 1; 
        $data['length'] = 1; 

        // Product Update Route
        $response = $this->put(route('admin.product.update', $model->id), $data);
        $response->assertRedirect(route('admin.product.index'));

        // Product Destroy Route
        $this->delete(route('admin.product.destroy', $model->id));
        $response->assertRedirect(route('admin.product.index'));

    }

    private function _getBasicDummyData($updateData = null)
    {
        $data['name'] = 'product test name';
        $data['type'] = 'BASIC';

        return $data;
    }
    private function _getDummyCategory($updateData = null)
    {
        $data['name'] = 'category name test';
        $data['slug'] = 'test-category-slug';

        $categoryRep = app()->get(CategoryInterface::class);

        return $categoryRep->create($data);
       
    }
}
