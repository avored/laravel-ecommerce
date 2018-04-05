@extends('layouts.app')

@section('meta_title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-2">
            @include('category.options')
        </div>
        <div class="col-10">
            <div class="row">
                @if(count($category->products) <= 0)
                    <p>Sorry No Product Found</p>
                @else

                    @foreach($products as $product)
                        <div class="col-4">
                            @include('product.view.product-card',['product' => $product])
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                    {!!  $products->links('pagination.bootstrap-4') !!}
                @endif
            </div>
        </div>

    </div>
@endsection
