<?php

use App\Customer;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerAuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginAction()
    {
        
        $this->visit('/customer/login')->see('Login');
        //Customer::destroy($customer->id);
    }
     /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostLoginAction()
    {
        $customer = factory(Customer::class,1)->create(['password' => 'admin123']);
        
        $this->visit('/customer/login')
                    ->type($customer->email, 'email')
                    ->type('admin123', 'password')
                    ->press('login')
                    ->seePageIs('/my-account');
        Customer::destroy($customer->id);
    }
}
