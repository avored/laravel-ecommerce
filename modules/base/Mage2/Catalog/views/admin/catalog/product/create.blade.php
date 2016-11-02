@extends('layouts.admin-bootstrap')


@section('content')
    <div class="row">
        <div class="main-title-wrap">
            <span class="title">Create Product</span>
        </div>

    </div>
        <div class="row">
            <div class="col s12">
                {!! Form::open(['action' => route('admin.product.store'),'method' => 'post']) !!}


                @include('admin.catalog.product.boxes.basic',['categories' => $categories])
                @include('admin.catalog.product.boxes.images')

                @include('admin.catalog.product.boxes.inventory')
                @include('admin.catalog.product.boxes.seo')

                <!--
                include('product.boxes.extra')
                    include('admin.product._fields',['productAttributes' => $productAttributes,
                                                    'websites' => $websites,
                                                    'categories' => $categories])
                
                -->
                {!! Form::submit('Create Product') !!}

                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection