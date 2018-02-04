@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">

        <div class="h1">

            {{ __('mage2-ecommerce::lang.category.index.title') }}


            @hasPermission('admin.category.create')
            <a style="" href="{{ route('admin.category.create') }}"
               class="btn btn-primary float-right">
                {{ __('mage2-ecommerce::lang.category.index.create') }}
            </a>
            @endHasPermission
        </div>
        {!! $dataGrid->render() !!}

    </div>
@stop