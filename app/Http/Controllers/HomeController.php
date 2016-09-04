<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use Mage2\Admin\Eloquents\Repository\ProductRepository;
use Mage2\Admin\Shipping\Facade\Shipping;

class HomeController extends Controller
{

    /**
     * @var AddressRepository
     */
    protected $productRepository;

    public function __construct(ProductRepository $repository){
        $this->productRepository = $repository;
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $featureProducts = $this->productRepository->getFeaturedProducts();
        return view('home')
                ->with('featuredProducts', $featureProducts);
    }
}
