<?php

namespace AvoRed\Ecommerce\Tests;

use AvoRed\Ecommerce\Provider;
use AvoRed\Framework\Provider as FrameworkProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class BaseTestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');
        $this->app['config']->set('app.url', 'http://localhost:8000/admin');
    
        $this->setUpDatabase();
        $this->resetDatabase();
    }

    private function resetDatabase()
    {
        $this->artisan('migrate', [
            '--database' => 'sqlite',
        ]);
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
            'Widget' => 'AvoRed\Framework\Widget\Facade'
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
}
