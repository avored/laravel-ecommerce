@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')

<h3>{{ __('wishlist.my_wishlist') }}</h3>
<div class="clearfix">&nbsp;</div>
    @if(count($wishlists) <= 0)
    <div class="alert alert-warning">
        <p> {{ __('wishlist.no_items') }}</p>
    </div>
    @else
        <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <th>{{ __('wishlist.product_title') }}</th>
                <th>{{ __('wishlist.product_image') }}</th>
                <th>{{ __('wishlist.actions') }}</th>
            </thead>
            <tbody>
                @foreach($wishlists as $wishlist)
                <tr>
                    <td>{{ $wishlist->product->name }}</td>
                    <td>@if(isset($wishlist->product->image) && is_string($wishlist->product->image->url))
                            <img alt="{{ $wishlist->product->name }}" class="img-responsive" style="max-height: 75px" src="{{ $wishlist->product->image->url }}"/>
                        @else
                            <img alt="{{ $wishlist->product->name }}" class="img-responsive" style="max-height: 75px" src="{{ asset('vendor/avored-default/images/default-product.jpg') }}"/>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('my-account.wishlist.remove', $wishlist->product->slug ) }}">{{ __('wishlist.remove') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
 </div>
@endif 
@endsection
