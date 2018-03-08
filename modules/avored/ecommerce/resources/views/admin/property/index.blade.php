@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
        <h1>
            <span class="main-title-wrap">{{ __('mage2-ecommerce::property.list') }}</span>
            <a style="" href="{{ route('admin.property.create') }}"
               class="btn btn-primary float-right">
                {{ __('mage2-ecommerce::property.create') }}
            </a>
        </h1>
        {!! $dataGrid->render() !!}
    </div>
    </div>
@stop