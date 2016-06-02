<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginAction()
    {
        
        $this->visit('/admin/login')->see('Login');
        //Customer::destroy($customer->id);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginPostAction()
    {
        $user = factory(User::class,1)->create(['password' => bcrypt('admin123')]);

        $this->visit('/admin/login')
            ->type($user->email, 'email')
            ->type('admin123', 'password')
            ->press('login')
            ->seePageIs('/admin')
            ->see('Dashboard');
        //Customer::destroy($customer->id);
    }



}
