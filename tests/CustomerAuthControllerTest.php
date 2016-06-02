<?php

use App\Customer;
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
        
        $customer = factory(Customer::class,1)->create(['password' => bcrypt('admin123')]);
        
        $this->visit('/customer/login')
                    ->type($customer->email, 'email')
                    ->type('admin123', 'password')
                    ->press('login')
                    ->seePageIs('/my-account');
        Customer::where('email', '=', $customer->email)->delete();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterAction()
    {
        //$user = factory(User::class,1)->create(['password' => bcrypt('admin123')]);

        //$this->visit('/customer/register')
        //    ->type('first name','first_name')
        //    ->type('last name','last_name')
        //    ->type('test@unittest.com', 'email')
        //    ->type('admin123', 'password')
        //    ->type('admin123','password_confirmation')
        //    ->press('register')
            //->seePageIs('/my-account')
        //    ;
        //Customer::where('email', '=', 'test@unittest.com')->delete();
    }
}
