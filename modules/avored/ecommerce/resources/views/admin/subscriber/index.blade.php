@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">{{ __('mage2-ecommerce::subscriber.list') }}</span>
            <a style="" href="{{ route('admin.subscriber.create') }}" class="btn btn-primary float-right">
                {{ __('mage2-ecommerce::subscriber.create') }}
            </a>
        </h1>
        {!! $dataGrid->render() !!}
    </div>

@stop