@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="item-container">	

            <div class="col-md-12">
                <div class="product col-md-3 service-image-left">

                    <center>
                       @if(isset($product->getProductImages($first = true)->value))
                                <img alt="{{ $product->title }}"
                                     class="img-responsive"
                                     src="/uploads/catalog/images/{{ $product->getProductImages($first= true)->value }}" />
                            @else 
                                <img alt="{{ $product->title }}"
                                     class="img-responsive"
                                     src="/img/default-product.jpg" />
                            @endif
                    </center>
                </div>

                <div class="container service1-items col-sm-2 col-md-2 pull-left">
                    <center>
                        <a id="item-1" class="service1-item">
                            <img class="img-responsive " 
                                 src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt="" />
                        </a>
                        <a id="item-2" class="service1-item">
                            <img class="img-responsive " src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt="" />
                        </a>
                        <a id="item-3" class="service1-item">
                            <img class="img-responsive " src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt="" />
                        </a>
                    </center>
                </div>


                <div class="col-md-7">
                    <div class="product-title">{{ $product->title }}</div>
                    <div class="product-desc">The Corsair Gaming Series GS600 is the ideal price/performance choice for mid-spec gaming PC</div>
                    <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
                    <hr>
                    <div class="product-price">$ {{ $product->price }}</div>
                    <div class="product-stock">In Stock</div>
                    <hr>
                    <div class="btn-group cart">
                        <a class="btn btn-primary" href="{{ route('cart.add-to-cart', $product->id) }}">Add to Cart</a> 
                    </div>
                    @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                        <div class="btn-group wishlist">
                            <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->id) }}">Remove from Wishlist</a>
                        </div>
                    @else
                        <div class="btn-group wishlist">
                            <a class="btn btn-warning" href="{{ route('wishlist.add', $product->id) }}">Add to Wishlist</a>
                        </div>
                    @endif
                </div>
            </div> 

            <div class="col-md-12 product-info">
                <ul id="myTab" class="nav nav-tabs nav_tabs">

                    <li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
                    <li><a href="#service-two" data-toggle="tab">PRODUCT INFO</a></li>
                    <li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>

                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="service-one">

                        <section class="container product-info">
                            The Corsair Gaming Series GS600 power supply is the ideal price-performance solution for building or upgrading a Gaming PC. A single +12V rail provides up to 48A of reliable, continuous power for multi-core gaming PCs with multiple graphics cards. The ultra-quiet, dual ball-bearing fan automatically adjusts its speed according to temperature, so it will never intrude on your music and games. Blue LEDs bathe the transparent fan blades in a cool glow. Not feeling blue? You can turn off the lighting with the press of a button.

                            <h3>Corsair Gaming Series GS600 Features:</h3>
                            <li>It supports the latest ATX12V v2.3 standard and is backward compatible with ATX12V 2.2 and ATX12V 2.01 systems</li>
                            <li>An ultra-quiet 140mm double ball-bearing fan delivers great airflow at an very low noise level by varying fan speed in response to temperature</li>
                            <li>80Plus certified to deliver 80% efficiency or higher at normal load conditions (20% to 100% load)</li>
                            <li>0.99 Active Power Factor Correction provides clean and reliable power</li>
                            <li>Universal AC input from 90~264V — no more hassle of flipping that tiny red switch to select the voltage input!</li>
                            <li>Extra long fully-sleeved cables support full tower chassis</li>
                            <li>A three year warranty and lifetime access to Corsair’s legendary technical support and customer service</li>
                            <li>Over Current/Voltage/Power Protection, Under Voltage Protection and Short Circuit Protection provide complete component safety</li>
                            <li>Dimensions: 150mm(W) x 86mm(H) x 160mm(L)</li>
                            <li>MTBF: 100,000 hours</li>
                            <li>Safety Approvals: UL, CUL, CE, CB, FCC Class B, TÜV, CCC, C-tick</li>
                        </section>

                    </div>
                    <div class="tab-pane fade" id="service-two">

                        <section class="container">

                        </section>

                    </div>
                    <div class="tab-pane fade" id="service-three">

                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
    @endsection
