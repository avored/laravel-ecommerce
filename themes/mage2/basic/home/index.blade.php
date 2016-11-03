@extends('layouts.app-bootstrap')

@section('content')
<div class="row">

    @if(count($featuredProducts) <= 0)
    <p>Sorry No Feature Product</p>
    @else

    <div class="col-md-12">

        <h4>Inside Theme Featured Products</h4>
        <div class="row">
        @foreach($featuredProducts as $product)
        <div class="col-md-4">
            @include('product.view.product-panel',['product'=> $product])
        </div>
        @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
