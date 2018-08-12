@extends('avored-framework::layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('avored-review::review.review-list') }}

        </div>
        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop
