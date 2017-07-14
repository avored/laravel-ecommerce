@extends('layouts.app')

@section('meta_title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('catalog.category.options')
        </div>
        <div class="col-md-10">
            @if(count($category->products) <= 0)
                <p>Sorry No Product Found</p>
            @else
                <?php $i = 0; ?>
                @foreach($products as $product)
                    <div class="col-md-4">
                        @include('catalog.product.view.product-panel',['product' => $product])
                    </div>
                    <?php  $i++; ?>
                    @if($i %3 == 0 && $i > 0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
                <div class="clearfix"></div>
                {!!  $products->links() !!}
            @endif
        </div>
    </div>
@endsection
