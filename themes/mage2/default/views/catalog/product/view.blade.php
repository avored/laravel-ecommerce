@extends('layouts.app')

@section('meta_title')
    {{ $product->title }}
@endsection

@section('content')

    <div class="row">
        <div class="item-container">
            <div class="col-md-12">
                <div class="product col-md-4 service-image-left">
                    @include('catalog.product.view.product-image')
                </div>


                <div class="col-md-8">
                    <h1 class="product-title">{{ $product->title }}</h1>

                    <div class="product-price"><span>$</span> <span
                                class="price">{{ number_format($product->price,2) }}</span></div>

                    @if($product->has_variation == 0 )
                        @include('catalog.product.view.type.basic-add-to-cart')
                    @elseif($product->has_variation == 1 )
                        @include('catalog.product.view.type.variation-add-to-cart')
                    @endif

                    <div class="pull-left">
                        @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                            <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->slug) }}">
                                Remove from Wishlist
                            </a>
                        @else
                            <a class="btn btn-warning" href="{{ route('wishlist.add', $product->slug) }}">
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
                    @foreach(Tabs::all('product-view') as $key => $tab)
                        <li>
                            <a data-toggle="tab" href="#{{ $key }}">
                                {{ $tab->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    <div id="description" class="tab-pane active col-md-12">
                        <p>{!! $product->description !!}</p>
                    </div>


                    <div id="review" class="tab-pane">

                        <div class="review-wrapper col-md-12">
                            @include('review.list',['product' => $product])
                            <div class="review-form-wrapper">
                                <h1>Add Review</h1>
                                @include('review.add-review-form',['product' => $product])
                            </div>
                        </div>
                    </div>

                    @foreach(Tabs::all('product-view') as $key => $tab)
                        @include($tab->view)
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection
