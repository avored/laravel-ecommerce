@extends('layouts.app')

@section('content')
    <div class="row profile">
        <div class="col s2">
            @include('my-account.sidebar')
        </div>
        <div class="col s10">
            <div class="title">
                <h4>My Wishlist</h4>
            </div>
            @if(count($wishlists) <= 0)
                <p>Sorry No Wishlists Found</p>
            @else

            <div class="panel panel-default">
                <div class="panel-heading">
                    My Wishlist
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($wishlists as $wishlist)
                            <tr>
                                <td> {{ $wishlist->product->title }}</td>
                                <td>
                                    @if(isset($wishlist->product->getProductImages($first = true)->value))
                                <img alt="{{ $wishlist->product->title }}"
                                     class="img-responsive"
                                     style="max-height: 75px"
                                     src="{{ asset('/uploads/catalog/images/'. $wishlist->product->getProductImages($first= true)->value) }}" />
                            @else 
                                <img alt="{{ $wishlist->product->title }}"
                                     class="img-responsive"
                                     style="max-height: 75px"
                                     src="/img/default-product.jpg) }}" />
                            @endif
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('wishlist.remove', $wishlist->product_id) }}">Remove from Wishlist</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @endif
        </div>
    </div>
@endsection
