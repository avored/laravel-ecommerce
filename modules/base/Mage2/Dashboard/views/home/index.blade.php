@extends('layouts.app')

@section('content')
<div class="row">
    @if(count($featuredProducts) <= 0)
    <p>Sorry No Feature Product</p>
    @else

    <div class="col s12">
        <div class="card-title"><h4>Inside Module Featured Products</h4></div>
        @foreach($featuredProducts as $product)
        <div class="col s4">
            @include('product.view.product-card',['product'=> $product])
        </div>
        @endforeach

    </div>
    @endif
</div>
@endsection
