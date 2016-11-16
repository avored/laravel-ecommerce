<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mage2\User\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginGet()
    {
        $this->visit('/login')
                ->see('Mage2 Login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginPost()
    {
        $user = $this->_createUser();

        $this->visit('/login')
            ->see('Mage2 Login')
            ->type($user->email, "email")
            ->type('admin123','password')
            ->press('Login')
            ->seePageIs('/my-account')
            ->see($user->email)
            ->see('First Name Test')
            ->see('Last Name Test')
            ;
    }

    private function _createUser() {
        $email = strtolower(str_random()) . "@gmail.com";
        $password = bcrypt('admin123');

        $user = User::create([
            'first_name' => 'First Name Test',
            'last_name' => 'Last Name Test',
            'email' => $email,
            'password' => $password,
        ]);

        return $user;
    }
}
