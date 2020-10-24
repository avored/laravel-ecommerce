<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        //Configuration for database to display the custome pages(eg.Admin,Catalog etc)
        $app['config']->set('database.dafult', 'dusk_testing');
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
