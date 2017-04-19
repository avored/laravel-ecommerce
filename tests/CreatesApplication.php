<?php

namespace Tests;



trait CreatesApplication
{
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

        $app = new \Mage2\Framework\Foundation\Application(
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
            \Illuminate\Contracts\Http\Kernel::class,
            \Mage2\Framework\System\Kernel::class
        );

        $app->singleton(
            \Illuminate\Contracts\Console\Kernel::class,
            \Illuminate\Foundation\Console\Kernel::class
        );

        $app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Mage2\Framework\Exceptions\Handler::class
        );

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();


        return $app;
    }
}
