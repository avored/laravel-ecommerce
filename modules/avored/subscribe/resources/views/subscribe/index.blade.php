@extends('avored-framework::layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">{{ __('avored-subscribe::subscribe.list') }}</span>
            <a style="" href="{{ route('admin.subscribe.create') }}" class="btn btn-primary float-right">
                {{ __('avored-subscribe::subscribe.create') }}
            </a>
        </h1>
        {!! DataGrid::render($dataGrid) !!}
    </div>

@stop
