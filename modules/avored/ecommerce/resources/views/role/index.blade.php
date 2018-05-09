@extends('avored-ecommerce::layouts.app')

@section('content')

    <div class="container">
        <div class="h1">
            {{ __('avored-ecommerce::role.role-list') }}

                <a href="{{ route('admin.role.create') }}"
                   class="float-right btn btn-primary"
                    title="{{ __('avored-ecommerce::role.role-create') }}"
                >
                    {{ __('avored-ecommerce::role.role-create') }}
                </a>

        </div>

        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop