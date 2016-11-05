@extends('layouts.admin-bootstrap')

@section('content')
    <div class="row">
        <div class="main-title-wrap">
            <span class="title">Edit Product</span>
        </div>

    </div>
    <div class="row">

        <div class="col-md-12">

            <?php 
            $productCategories = $product->categories()->get()->pluck('id')->toArray();
            $productWebsites = $product->websites()->get()->pluck('id')->toArray();
            
            ?>
            {!! Form::bind($product, ['method' => 'PUT', 'action' => route('admin.product.update', $product->id)]) !!}

            
            @include('admin.catalog.product.boxes.basic',
                            ['categories' => $categories, 
                            'productCategories' => $productCategories,
                            'productWebsites' => $productWebsites])
            @include('admin.catalog.product.boxes.images')
            
            @include('admin.catalog.product.boxes.inventory')
            @include('admin.catalog.product.boxes.seo')
            <!--
            include('admin.catalog.product.boxes.images')
                include('product.boxes.extra')
                include('admin.product._fields', ['websites' => $websites,'categories' => $categories])
            -->
            @include('template.hidden',['key' => 'id'])
            <div class="input-field">
                {!! Form::submit("Update Product",['class' => 'btn btn-primary']) !!}
                {!! Form::button("Cancel",['class' => 'btn btn-default']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection