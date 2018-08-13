@extends('avored-framework::layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('avored-promotion::promotion.promotion-list') }}

            <a href="{{ route('admin.promotion.create') }}"
               class="float-right btn btn-primary">
                {{  __('avored-promotion::promotion.promotion-create') }}
            </a>

        </div>
        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop
