<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminProductTest extends TestCase
{
    /**
     * A basic admin product index route test.
     *
     * @return void
     */
    public function testAdminProductIndex()
    {
        $this->adminUserLogin();
        $this->visit('/admin/product')->see('Product List');
    }
    /**
     * A basic admin product index route test.
     *
     * @return void
     */
    public function testAdminProductCreate()
    {
        $this->adminUserLogin();
        $this->visit('/admin/product/create')->see('Create Product');
    }
}
