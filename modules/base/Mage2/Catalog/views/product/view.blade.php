@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="item-container">	

            <div class="col s12">
                <div class="product col s3 service-image-left">

                    <center>
                       @if(isset($product->getProductImages($first = true)->value))
                                <img alt="{{ $product->title }}"
                                     class="responsive-img"
                                     src="{{ asset('/uploads/catalog/images/'. $product->getProductImages($first= true)->value)  }}" />
                            @else 
                                <img alt="{{ $product->title }}"
                                     class="responsive-img"
                                     src="{{ asset('/img/default-product.jpg') }}" />
                            @endif
                    </center>
                </div>



                <div class="col s7">
                    <h1 class="product-title">{{ $product->title }}</h1>
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

            <div class="col s12 product-info">
                <ul id="myTab" class="nav nav-tabs nav_tabs">
                    <li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="service-one">

                        <section class="container product-info">
                            <p>
                            {!! $product->description !!}
                            </p>
                        </section>

                    </div>

                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
    @endsection
