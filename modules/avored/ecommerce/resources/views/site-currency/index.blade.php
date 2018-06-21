@extends('avored-ecommerce::layouts.app')

@section('content')

    <div class="h1">
        {{ __('avored-ecommerce::currency.title') }}

            <a href="{{ route('admin.site-currency.create') }}"
                class="float-right btn btn-primary">
                {{ __('avored-ecommerce::currency.create') }}
            </a>

    </div>
    {!! DataGrid::render($dataGrid) !!}

@stop
