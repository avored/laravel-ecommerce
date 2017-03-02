@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="main-title-wrap">
            <span class="title">Create Product</span>
        </div>

    </div>
        <div class="row">
            <div class="col s12">
                {!! Form::open(['action' => route('admin.product.store'),'method' => 'post']) !!}



                @include('mage2catalog::admin.catalog.product.basic-panel' )
                @include('mage2catalog::admin.catalog.product.images' )
                @include('mage2catalog::admin.catalog.product.inventory-panel' )
                @include('mage2catalog::admin.catalog.product.seo-panel' )

                @include('admin.catalog.product.attribute');

                {!! Form::submit('Create Product') !!}

                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection