@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="item-container">


                @if(session()->has('notificationText'))
                    <div class="chip notification">
                        {{ session()->get('notificationText') }}
                        <i class="close material-icons">close</i>
                    </div>
                @endif

                <div class="col s12">
                    <div class="product col s3 service-image-left">

                        <center>
                            @if(isset($product->getProductImages($first = true)->value))
                                <img alt="{{ $product->title }}"
                                     class="responsive-img"
                                     src="{{ asset('/uploads/catalog/images/'. $product->getProductImages($first= true)->value)  }}"/>
                            @else
                                <img alt="{{ $product->title }}"
                                     class="responsive-img"
                                     src="{{ asset('/img/default-product.jpg') }}"/>
                            @endif
                        </center>
                    </div>


                    <div class="col s7">
                        <h1 class="product-title">{{ $product->title }}</h1>
                        <p>
                            <a href="#">Add Review</a>
                        </p>
                        <div class="product-price">$ {{ $product->price }}</div>

                        <div class="product-stock">In Stock</div>
                        <hr>
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{ route('cart.add-to-cart', $product->id) }}">Add to
                                Cart</a>

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

                <div class="col s12 product-info">
                    <ul class="tabs">
                        <li class="tab col s3"><a href="#description">DESCRIPTION</a></li>
                        <li class="tab col s3"><a class="active" href="#review">REVIEW</a></li>
                    </ul>

                    <div id="description">
                        <p>{!! $product->description !!}</p>
                    </div>

                    <div id="review">

                        <div class="review-wrapper">
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

@endsection
