<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Mage2\Framework\Configuration\Facades\AdminConfiguration;

class AdminConfigurationTest extends TestCase
{
     /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminConfigurationIndex()
    {
        $this->adminUserLogin();
        $this->visit('/admin/configuration');
        //@todo not working now
        //$configurations =  AdminConfiguration::shouldReceive('all')->once();
        //dd($configurations);
        
                    //->see('Order List')
                
            
    }
}
