<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminThemeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminThemeList()
    {
        $this->adminUserLogin();
        $this->visit('/admin/themes')
                ->see('Theme List')
                ;
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminThemeUploadTheme()
    {
        $this->adminUserLogin();
        $this->visit('/admin/themes/create')
                ->see('Upload Theme')
                ;
    }
}
