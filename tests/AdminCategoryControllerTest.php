<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
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
        $this->visit('/admin/category')->see("Category List");
    }
    /**
     * @return void
     */
    public function testAdminCategoryCreate()
    {
        $this->adminUserLogin();
        $this->assertTrue(true);
        $this->visit('/admin/category/create')->see("Create Category");
    }
    /**
     * @return void
     */
    public function testAdminCategoryStore()
    {
        $this->adminUserLogin();
        $this->assertTrue(true);
        
        //@todo If we run test second time it will fail. (try to use data using faker).
        Category::where('slug','=','test-category')->delete();
        
        $this->visit('/admin/category/create')
                    ->see("Create Category")
                    ->type('Test Category','name')
                    ->type('test-category','slug')
                    ->select('0','parent_id')
                    ->press('Create Category')
                    ->seePageIs('/admin/category')
                    ->see('Test Category');
            
            ;
    }
}
