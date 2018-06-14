<?php

namespace AvoRed\Ecommerce\Tests\Controller;

use AvoRed\Ecommerce\Tests\BaseTestCase;
use AvoRed\Ecommerce\Models\Contracts\PageInterface;

class PageTest extends BaseTestCase
{
    /**
     * Test to check if page resource route is working
     *
     * @return void
     */
    public function testPageRosourceRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.page.index'));
        $response->assertStatus(200);
        $response->assertSee('Pages List');

        $response = $this->get(route('admin.page.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Page');

        $data['name'] = 'page name test';
        $data['slug'] = 'test-page-slug';
        $data['content'] = 'some page test content';

        $response = $this->post(route('admin.page.store'), $data);
        $response->assertRedirect(route('admin.page.index'));

        $repository = app()->get(PageInterface::class);

        $model = $repository->query()->whereSlug('test-page-slug')->first();

        $response = $this->get(route('admin.page.edit', $model->id));
        $response->assertStatus(200);

        $updateData['name'] = 'updated page name test';
        $updateData['slug'] = 'test-page-slug';
        $updateData['content'] = 'some page test content';

        $response = $this->put(route('admin.page.update', $model->id), $updateData);

        $response->assertRedirect(route('admin.page.index'));

        $this->delete(route('admin.page.destroy', $model->id));
        $response->assertRedirect(route('admin.page.index'));
    }
}
