@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('mage2-ecommerce::tax-rule.list') }}
            <a style="" href="{{ route('admin.tax-rule.create') }}"
               class="btn btn-primary float-right">
                {{ __('mage2-ecommerce::tax-rule.create') }}
            </a>
        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop