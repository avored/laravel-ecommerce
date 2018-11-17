<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminConfiguration\Facade as AdminConfigurationFacade;

class AvoRedConfigurationProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $configurationGroup = AdminConfigurationFacade::get('users');

        $configurationGroup->addConfiguration('users_facebook_client_id')
            ->label('facebook Client Id')
            ->type('text')
            ->name('users_facebook_client_id');

        $configurationGroup->addConfiguration('users_facebook_client_secret')
            ->label('facebook Client Secret')
            ->type('text')
            ->name('users_facebook_client_secret');

        $configurationGroup->addConfiguration('users_twitter_client_id')
            ->label('twitter Client Id')
            ->type('text')
            ->name('users_twitter_client_id');

        $configurationGroup->addConfiguration('users_twitter_client_secret')
            ->label('twitter Client Secret')
            ->type('text')
            ->name('users_twitter_client_secret');

        $configurationGroup->addConfiguration('users_google_client_id')
            ->label('google Client Id')
            ->type('text')
            ->name('users_google_client_id');

        $configurationGroup->addConfiguration('users_google_client_secret')
            ->label('google Client Secret')
            ->type('text')
            ->name('users_google_client_secret');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
