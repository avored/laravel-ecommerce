@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('avored-ecommerce::tax-rule.list') }}
            <a style="" href="{{ route('admin.tax-rule.create') }}"
               class="btn btn-primary float-right">
                {{ __('avored-ecommerce::tax-rule.create') }}
            </a>
        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop