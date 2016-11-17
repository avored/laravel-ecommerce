<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Mage2\User\Models\AdminUser;
use Mage2\Configuration\Models\Configuration;
use Mage2\Install\Models\Website;
use Mage2\User\Models\User;
use Mage2\User\Models\Role;
abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://mage2-ecommerce';
    public $websiteId;
    public $defaultWebsiteId;
    public $isDefaultWebsite;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        /*
        |--------------------------------------------------------------------------
        | Turn On The Lights
        |--------------------------------------------------------------------------
        |
        | We need to illuminate PHP development, so let us turn on the lights.
        | This bootstraps the framework and gets it ready for use, then it
        | will load up this application so that we can run it and send
        | the responses back to the browser and delight our users.
        |
        */

        $app = new Mage2\Framework\Foundation\Application(
            realpath(__DIR__.'/../')
        );

        /*
        |--------------------------------------------------------------------------
        | Bind Important Interfaces
        |--------------------------------------------------------------------------
        |
        | Next, we need to bind some important interfaces into the container so
        | we will be able to resolve them when needed. The kernels serve the
        | incoming requests to this application from both the web and CLI.
        |
        */

        $app->singleton(
            Illuminate\Contracts\Http\Kernel::class,
            Mage2\Framework\System\Kernel::class
        );

        $app->singleton(
            Illuminate\Contracts\Console\Kernel::class,
            Illuminate\Foundation\Console\Kernel::class
        );

        $app->singleton(
            Illuminate\Contracts\Debug\ExceptionHandler::class,
            Mage2\Framework\Exceptions\Handler::class
        );

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();


        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        putenv('DB_CONNECTION=sqlite_testing');
        if (!Schema::hasTable('migrations')) {
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
            ->type('admin@admin.com', 'email')
            ->type('admin123', 'password')
            ->press('Login');
    }

    public function frontAuthTest()
    {
        $this->_createFrontUser();
        $this->visit('/login')
            ->see('Mage2 Login')
            ->type('front@front.com', 'email')
            ->type('admin123', 'password')
            ->press('Login')
            ->seePageIs('/my-account');
    }

    private function _createFrontUser()
    {
        if (count((User::where('email', '=', 'front@front.com')->get())) <= 0) {
            User::create([
                'first_name' => 'test User',
                'last_name'  => 'test User',
                'email'      => 'front@front.com',
                'password'   => bcrypt('admin123'),
            ]);
        }
    }

    private function setupAdminUserAndWebsite()
    {
        $role = Role::create(['name' => 'Administrator',
                                'description' => 'administrator role'
                        ]);
        
        AdminUser::create([
            'first_name' => 'test User',
            'last_name'  => 'test User',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('admin123'),
            'is_super_admin' => 1,
            'role_id'    => $role->id, // @todo change this one??
        ]);

        $host = str_replace('http://', '', $this->baseUrl);
        $host = str_replace('https://', '', $host);
        $website = Website::create([
            'host'       => $host,
            'name'       => 'Defaul Website',
            'is_default' => 1,
        ]);

        Configuration::create([
            'configuration_key'   => 'active_theme_path',
            'configuration_value' => base_path('themes/mage2/default'),
            'website_id'          => $website->id,


        ]);
        Configuration::create([
            'configuration_key'   => 'active_theme_name',
            'configuration_value' => 'mage2-default',
            'website_id'          => $website->id,

        ]);
    }

    public function setupWebsiteIdFromSession()
    {
        $this->websiteId = Session::get('website_id');
        $this->defaultWebsiteId = Session::get('default_website_id');
        $this->isDefaultWebsite = Session::get('is_default_website');
    }
}
