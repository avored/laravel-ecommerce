<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminOrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminOrderIndex()
    {
        $this->adminUserLogin();
        $this->visit('/admin/order')
                    ->see('Order List')
                
            ;
    }
}
