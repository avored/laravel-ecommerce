<?php
namespace Mage2\Framework\Form;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Form\FormGenerator;

class FormServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerFormBuilder();
        $this->app->alias('form', 'Mage2\Framework\Form\FormGenerator');
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            //dd(($app['request']->session()));
            $form = new FormGenerator($app['files'], $app['url'], $app['request'], $app['view'], $app['session.store']->token());

            return $form->setSessionStore($app['session.store']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['form', 'Mage2\Framework\Form\FormGenerator'];
    }
}