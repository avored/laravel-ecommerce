<?php

namespace AvoRed\Ecommerce\Tests;

use AvoRed\Ecommerce\Provider;
use AvoRed\Framework\Provider as FrameworkProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Ecommerce\Models\Database\AdminUser;

abstract class BaseTestCase extends OrchestraTestCase
{
    /**
     * Admin User
     * @var \AvoRed\Ecommerce\Models\Database\AdminUser
     */
    protected $user = null;

    public function setUp()
    {
        parent::setUp();
        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
        //$this->app['config']->set('app.url', 'http://localhost:8000');

        $this->setUpDatabase();
    }

    private function resetDatabase()
    {
        $this->artisan('migrate', ['--database' => 'sqlite']);
    }

    protected function getPackageProviders($app)
    {
        return [
            FrameworkProvider::class,
            Provider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'AdminMenu' => 'AvoRed\\Framework\\AdminMenu\\Facade',
            'AdminConfiguration' => 'AvoRed\\Framework\\AdminConfiguration\\Facade',
            'Breadcrumb' => 'AvoRed\\Framework\\Breadcrumb\\Facade',
            'Cart' => 'AvoRed\\Framework\\Cart\\Facade',
            'DataGrid' => 'AvoRed\\Framework\\DataGrid\\Facade',
            'Image' => 'AvoRed\\Framework\\Image\\Facade',
            'Menu' => 'AvoRed\\Framework\\Menu\\Facade',
            'Payment' => 'AvoRed\\Framework\\Payment\\Facade',
            'Permission' => 'AvoRed\\Framework\\Permission\\Facade',
            'Shipping' => 'AvoRed\\Framework\\Shipping\\Facade',
            'Tabs' => 'AvoRed\\Framework\\Tabs\\Facade',
            'Theme' => 'AvoRed\\Framework\\Theme\\Facade',
            'Widget' => 'AvoRed\\Framework\\Widget\\Facade'
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase()
    {
        $this->resetDatabase();
    }

    /**
     * Get Admin User Object for unit test
     *
     * @return \AvoRed\Ecommerce\Models\Database\AdminUser
     */
    protected function _getAdminUser()
    {
        if (null === $this->user) {
            $role = Role::create(['name' => 'Administrator', 'description' => 'Administrator']);
            $this->user = AdminUser::create(['role_id' => $role->id,
                                            'is_super_admin' => 1,
                                            'first_name' => 'Purvesh',
                                            'last_name' => 'Patel',
                                            'email' => 'admin@admin.com',
                                            'password' => bcrypt('admin123')
                                        ]);
        }
        return $this->user;
    }
}
