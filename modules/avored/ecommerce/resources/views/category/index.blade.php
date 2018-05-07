@extends('avored-ecommerce::layouts.app')

@section('content')

        <div class="h1">

            {{ __('avored-ecommerce::lang.category.index.title') }}


            @hasPermission('admin.category.create')
                <a style="" href="{{ route('admin.category.create') }}"
                   class="btn btn-primary float-right">
                    {{ __('avored-ecommerce::lang.category.index.create') }}
                </a>
            @elsehasPermission
                <button type="button" class="btn float-right" disabled>
                    {{ __('avored-ecommerce::lang.category.index.create') }}
                </button>
            @endhasPermission
        </div>
        {!! DataGrid::render($dataGrid) !!}


@stop
