@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('avored-ecommerce::user.admin-user-list') }}

                <a href="{{ route('admin.admin-user.create') }}"
                   class="float-right btn btn-primary">
                    {{ __('avored-ecommerce::user.admin-user-create') }}
                </a>

        </div>
        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop
