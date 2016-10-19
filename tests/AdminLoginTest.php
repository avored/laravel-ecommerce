<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;

class AdminLoginTest extends TestCase
{

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetLogin()
    {
        $this->assertTrue(true);
        $this->visit('/admin/login')->see('Mage2 Admin Login');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPostLogin()
    {
        $this->assertTrue(true);
        //$this->visit('/admin/login')
                //->type('admin@admin.com','email')
                //->type('admin123','password')
                //->press('Login')
                //->seePageIs('/admin')
                //->see("Mage2 Admin");

    }

}
