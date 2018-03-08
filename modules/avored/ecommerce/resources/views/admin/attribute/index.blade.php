@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">{{ __('avored-ecommerce::attribute.list') }}</span>
            <a style="" href="{{ route('admin.attribute.create') }}"
               class="btn btn-primary float-right">
                {{ __('avored-ecommerce::attribute.create') }}
            </a>
        </h1>
        {!! $dataGrid->render() !!}
    </div>

@stop