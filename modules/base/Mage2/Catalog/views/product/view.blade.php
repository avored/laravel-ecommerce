@extends('layouts.app-bootstrap')

@section('content')

        <div class="row">
            <div class="item-container">
                <div class="col-md-12">
                    <div class="product col-md-4 service-image-left">
                        <center>
                            @if(isset($product->getProductImages($first = true)->value))
                                <img alt="{{ $product->title }}"
                                     class="img-responsive"
                                     src="{{ asset('/uploads/catalog/images/'. $product->getProductImages($first= true)->value)  }}"/>
                            @else
                                <img alt="{{ $product->title }}"
                                     class="img-responsive"
                                     src="{{ asset('/img/default-product.jpg') }}"/>
                            @endif
                        </center>
                    </div>


                    <div class="col-md-8">
                        <h1 class="product-title">{{ $product->title }}</h1>

                        <div class="product-price">$ {{ $product->price }}</div>

                        <div class="product-stock">In Stock</div>
                        <hr>
                        <div class="">
                            <a class="btn btn-primary" href="{{ route('cart.add-to-cart', $product->id) }}">
                                Add to Cart
                            </a>

                            @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                                <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->id) }}">
                                    Remove from Wishlist
                                </a>
                            @else
                                <a class="btn btn-danger" href="{{ route('wishlist.add', $product->id) }}">
                                    Add to Wishlist
                                </a>

                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 product-info">
                    <ul class="nav nav-tabs">
                        <li class="tab active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                        <li class="tab"><a data-toggle="tab" href="#review">REVIEW</a></li>
                    </ul>

                    <div class="tab-content">
                    <div id="description" class="tab-pane active col-md-12">
                        <p>{!! $product->description !!}</p>
                    </div>

                    <div id="review" class="tab-pane">

                        <div class="review-wrapper col-md-12" >
                            @include('review.list',['product' => $product])
                            <div class="review-form-wrapper" >
                            <h1>Add Review</h1>
                            @include('review.add-review-form',['product' => $product])
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
