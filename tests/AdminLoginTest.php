<?php


class AdminLoginTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetLogin()
    {
        
        $this->visit($this->baseUrl.'/admin/login')
                    ->seePageIs($this->baseUrl.'/admin/login')
                    ->see('Mage2 Admin Login');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPostLogin()
    {
        $this->visit('/admin/login')
                ->type('admin@admin.com', 'email')
                ->type('admin123', 'password')
                ->press('Login')
                ->seePageIs('/admin')
                ->see('Mage2 Admin');
    }
}
