@extends('avored-ecommerce::layouts.app')

@section('content')

        <h1>
            <span class="main-title-wrap">{{ __('avored-ecommerce::lang.product.index.title') }}</span>
            <a style="" href="{{ route('admin.product.create') }}" class="btn btn-primary float-right">
                {{ __('avored-ecommerce::lang.product.create.text') }}
            </a>
        </h1>

        {!! DataGrid::render($dataGrid) !!}

@stop
