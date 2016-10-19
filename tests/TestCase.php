<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Mage2\Auth\Models\AdminUser;
use Mage2\Install\Models\Website;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://mage2-ecommerce';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();


        return $app;
    }

    public function setUp()
    {


        parent::setUp();

        putenv('DB_CONNECTION=sqlite_testing');
        if(!Schema::hasTable('migrations')){

            Artisan::call('mage2:migrate');
            Artisan::call('db:seed');
            $this->setupAdminUserAndWebsite();


        }

        //Artisan::call('db:seed');

    }

     /**
     * A basic functional test example.
     *
     * @return void
     */
    public function adminUserLogin()
    {
        $this->visit('/admin/login')
                ->type('admin@admin.com','email')
                ->type('admin123','password')
                ->press('Login');

    }

    private function setupAdminUserAndWebsite() {
        AdminUser::create([
            'first_name' => "test User",
            'last_name' => "test User",
            'email' => "admin@admin.com",
            'password' => bcrypt("admin123"),
            'role_id' => 1, // @todo change this one??
        ]);

        $host = str_replace("http://", "", $this->baseUrl);
        $host = str_replace("https://","", $host);
        $website = Website::create([
                    'host' => $host,
                    'name' => 'Defaul Website',
                    'is_default' => 1
                ]);

        Configuration::create([
            'configuration_key' => 'active_theme_path',
            'configuration_value' => base_path('themes/mage2/default'),
            'website_id' => $website->id


        ]);
         Configuration::create([
             'configuration_key' => 'active_theme_name',
             'configuration_value' => 'mage2-default',
             'website_id' => $website->id

        ]);
    }
}
