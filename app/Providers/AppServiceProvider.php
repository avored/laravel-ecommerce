<?php
namespace App\Providers;

use CrazyCommerce\Admin\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use CrazyCommerce\Admin\Models\ProductAttribute;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        //dd(realpath(base_path('resources/views')));
        //$themePath = realpath(base_path('themes'));

        //Config::set('view.paths', [$themePath]);

        view()->composer(['crazy::layouts.admin','template.header-nav'], function ($view) {
            $user = Auth::guard('admin')->user();
            $view->with('user', $user);
        });
        view()->composer(['default.my-account.sidebar'], function ($view) {
            $user = Auth::user();
            $view->with('user', $user);
        });
        
        view()->composer('*', function ($view) {
            $view->with('isDefaultWebsite', Session::get('is_default_website'));
        });
        
        view()->composer('crazy::product.boxes.inventory', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $trackStockOptions = $productAttrobuteModel->getTrackStockOptions();
            $inStockOptions = $productAttrobuteModel->getInStockOptions();

            $view
                ->with('trackStockOptions', $trackStockOptions)
                ->with('inStockOptions', $inStockOptions)

                ;
        });
        view()->composer('crazy::product.boxes.basic', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $isFeaturedOptions = $productAttrobuteModel->getIsFeaturedOptions();
            $statusOptions = $productAttrobuteModel->getStatusOptions();
            $view
                ->with('isFeaturedOptions', $isFeaturedOptions)
                ->with('statusOptions',$statusOptions)
            ;
        });

        view()->composer('layouts.app', function ($view) {
            //$websiteId = Session::get('website_id');
            //$baseCategories = Category::where('parent_id','=','')
            //                        ->where('website_id','=',$websiteId)
            //                        ->get();

            $cart = count(Session::get('cart'));
            $categoryModel = new Category();
            $baseCategories = $categoryModel->getAllCategories();
            $view->with('categories', $baseCategories)
                    ->with('cart', $cart)
                ;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
