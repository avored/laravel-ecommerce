@extends('layouts.app')

@section('meta_title')
    {{ $title }}
@endsection

@section('meta_description')
    {{ $description }}
@endsection

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-4">
                @include('product.view.product-image',['imageType' => 'largeUrl','extraImage' => true])
                </div>

            <div class="col-8">
                <h1 class="product-name">{{ $product->name }}</h1>

                <div class="product-price">
                    <span>$</span>
                    <span class="price">{{ number_format($product->price,2) }}</span>
                </div>

                    @if($product->type == 'BASIC')
                        @include('product.view.type.basic-add-to-cart')
                    @endif
                    @if($product->type == 'VARIATION' )
                        @include('product.view.type.variation-add-to-cart')
                    @endif
                    @if($product->type == 'DOWNLOADABLE' )
                        @include('product.view.type.downloadable-add-to-cart')
                    @endif

                <div class="float-left">
                        @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                            <a class="btn btn-danger" href="{{ route('my-account.wishlist.remove', $product->slug) }}">
                                <i class="fa fa-heart"></i>
                            </a>
                        @else
                            <a class="btn btn-warning" href="{{ route('my-account.wishlist.add', $product->slug) }}">
                                <i class="fa fa-heart"></i>
                            </a>

                        @endif
                    </div>
                </div>

        </div>
        <div class="row">
            <p>&nbsp;</p>
        </div>
        <div class="row">

            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a data-toggle="tab" class="nav-link" href="#description">
                            <div class="h4"> DESCRIPTION</div>
                        </a>
                    </li>

                    @foreach(Tabs::all('product-view') as $key => $tab)
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#{{ $key }}">
                                {{ $tab->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content ">
                    <div id="description" class="tab-pane pt-3 active">

                        <p>{!! $product->description !!}</p>
                    </div>


                    @foreach(Tabs::all('product-view') as $key => $tab)
                        @include($tab->view)
                    @endforeach
                </div>

                @include("avored-related::related.product.list")


                @include("avored-review::product.review")

            </div>
        </div>

    </div>
@endsection
