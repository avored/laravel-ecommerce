@extends('avored-framework::layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('avored-banner::banner.banner-list') }}

            <a href="{{ route('admin.banner.create') }}"
               class="float-right btn btn-primary">
                {{  __('avored-banner::banner.banner-create') }}
            </a>

        </div>
        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop
