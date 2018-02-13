@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="container">
        <div class="h1">
            {{ __('mage2-ecommerce::role.role-list') }}

                <a href="{{ route('admin.role.create') }}"
                   class="float-right btn btn-primary"
                    title="{{ __('mage2-ecommerce::role.role-create') }}"
                >
                    {{ __('mage2-ecommerce::role.role-create') }}
                </a>

        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop