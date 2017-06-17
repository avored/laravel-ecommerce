<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider as LaravelConsoleServiceProvider;

class ConsoleServiceProvider extends LaravelConsoleServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        'Mage2\Framework\Foundation\Providers\ArtisanServiceProvider',
        'Mage2\Framework\Database\MigrationServiceProvider',
        'Mage2\Framework\Database\SeedServiceProvider',
    ];
}
