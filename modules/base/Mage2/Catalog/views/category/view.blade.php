@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        @if(count($category->products) <= 0)
        <p>Sorry No Product Found</p>
        @else
        @foreach($category->products as $product)
        <div class="col s4">
            @include('product.view.product-card',['product' => $product])
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
