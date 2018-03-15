<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Repository\Product;
use Illuminate\View\View;
use AvoRed\Ecommerce\Repository\Config;

class LayoutAppComposer
{

    /*
    * AvoRed Framework Category Repository
    *
    * @var \AvoRed\Framework\Repository\Product
    */
    public $productRepository;

    /*
   * AvoRed Framework Category Repository
   *
   * @var \AvoRed\Ecommerce\Repository\Config
   */
    public $configRepository;

    public function __construct(Product $repository, Config $configRepository)
    {
        $this->productRepository    =  $repository;
        $this->configRepository     = $configRepository;
    }



    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $cart = (null === Session::get('cart')) ? 0 : count(Session::get('cart'));

        $baseCategories = $this->productRepository->categoryModel()->getAllCategories();

        $metaTitle = $this->configRepository->model()->getConfiguration('general_site_title');
        $metaDescription = $this->configRepository->model()->getConfiguration('general_site_description');


        $view->with('categories', $baseCategories)
            ->with('cart', $cart)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }

}
