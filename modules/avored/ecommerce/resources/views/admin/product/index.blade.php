@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">{{ __('mage2-ecommerce::lang.product.index.title') }}</span>
            <a style="" href="{{ route('admin.product.create') }}" class="btn btn-primary float-right">
                {{ __('mage2-ecommerce::lang.product.create.text') }}
            </a>
        </h1>

        {!! $dataGrid->render() !!}
    </div>
@stop