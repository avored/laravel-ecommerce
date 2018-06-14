<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class CategoryTest extends BaseTestCase
{
    /**
     * Test to check if category resource route is working
     *
     * @return void
     */
    public function testCategoryRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.category.index'));
        $response->assertStatus(200);
        $response->assertSee('Category List');

        $response = $this->get(route('admin.category.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Category');

        $data['name'] = 'category name test';
        $data['slug'] = 'test-category-slug';

        $response = $this->post(route('admin.category.store'), $data);
        $response->assertRedirect(route('admin.category.index'));

        $categoryRepository = app()->get(CategoryInterface::class);

        $categoryModel = $categoryRepository->findByKey('test-category-slug');

        $response = $this->get(route('admin.category.edit', $categoryModel->id));
        $response->assertStatus(200);

        $updateData['name'] = 'updated category name test';
        $updateData['slug'] = 'test-category-slug';

        $response = $this->put(route('admin.category.update', $categoryModel->id), $updateData);

        $response->assertRedirect(route('admin.category.index'));

        $this->delete(route('admin.category.destroy', $categoryModel->id));
        $response->assertRedirect(route('admin.category.index'));
    }
}
