@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row profile">
        <div class="col-md-2">
            @include('default.my-account.sidebar')
        </div>
        <div class="col-md-10">
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
                            <th>ID</th>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($wishlists as $wishlist)
                            <tr>
                                <td> {{ $wishlist->product->id }}</td>
                                <td> {{ $wishlist->product->title }}</td>
                                <td>
                                    <img src="/uploads/catalog/images/{{ $wishlist->product->getProductImages($first= true)->value }}" title="{{ $wishlist->product->title}}"
                                        style="max-height: 75px"
                                    />
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
</div>
@endsection