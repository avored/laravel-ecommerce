<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterUserTest extends TestCase
{
    /**
     * A basic test for register Get.
     *
     * @return void
     */
    public function testRegisterGet()
    {
        $this->visit('/register')
            ->see('Register');
    }

    /**
     * A basic test for register post.
     *
     * @return void
     */
    public function testRegisterPost()
    {
        $randomEmail = strtolower(str_random(10)) . "@gmail.com";


        $this->visit('/register')
            ->see('Register')
            ->type('test first name','first_name')
            ->type('test last name','last_name')
            ->type($randomEmail,'email')
            ->type('admin123','password')
            ->type('admin123','password_confirmation')
            ->press('Register')
            ->seePageIs('/my-account')
            ->see('test first name')
            ->see('test last name')
            ->see($randomEmail)
            ;
    }
}
