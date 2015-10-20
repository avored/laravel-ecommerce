<?php

namespace App\Providers;

use Mage2\Core\Model\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
          View::composer(['front.includes.header'], function($view)
        {

              $model = new Category();
              $categories = $model->getCategoryTree();
              $view->with('categories', $categories);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //


    }
}
