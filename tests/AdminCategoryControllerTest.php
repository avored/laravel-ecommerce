<?php

use Mage2\Catalog\Models\Category;

class AdminCategoryControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testAdminCategoryIndex()
    {
        $this->adminUserLogin();
        $this->assertTrue(true);
        $this->visit('/admin/category')->see('Category List');
    }

    /**
     * Admin Category Create Test.
     *
     * @return void
     */
    public function testAdminCategoryCreate()
    {
        $this->adminUserLogin();

        $this->_deleteTestCategory();

        $this->visit('/admin/category/create')
                ->see('Create Category')
                ->type('Test Category', 'name')
                ->type('test-category', 'slug')
                //->select('0', 'parent_id')
                ->press('Create Category')
                ->seePageIs('/admin/category')
                ->see('Test Category');
    }

    /**
     * Admin Category Edit Test.
     *
     * @return void
     */
    public function testAdminCategoryUpdate()
    {
        $this->adminUserLogin();
        $this->setupWebsiteIdFromSession();
        $this->_deleteTestCategory();

        $category = $this->_createTestCategory();
        $this->visit('/admin/category/'.$category->id.'/edit')
                ->see('Edit Category')
                ->seeInField('name', 'test category')
                ->seeInField('slug', 'test-category')
                ->type('test category update', 'name')
                ->press('Update Category')
                ->seePageIs('/admin/category')
                ->see('test category update');
    }

    /**
     * Admin Category DestroyS Test.
     *
     * @return void
     */
    public function testAdminCategoryDestroy()
    {
        $this->adminUserLogin();
        $this->_deleteTestCategory();
        $this->setupWebsiteIdFromSession();

        $category = $this->_createTestCategory();
        $this->makeRequest('DELETE', '/admin/category/'.$category->id)
                    ->seePageIs('/admin/category')
                    ->dontSee('test category');
    }

    public function _createTestCategory()
    {
        $category = Category::create([
                    'name'       => 'test category',
                    'slug'       => 'test-category',
                    'parent_id'  => 0,
                    'website_id' => $this->defaultWebsiteId,
        ]);

        return $category;
    }

    public function _deleteTestCategory()
    {
        //@todo If we run test second time it will fail. (try to use data using faker).
        Category::where('slug', '=', 'test-category')->delete();
    }
}
