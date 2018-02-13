@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('mage2-ecommerce::user.admin-user-list') }}

                <a href="{{ route('admin.admin-user.create') }}"
                   class="float-right btn btn-primary">
                    {{ __('mage2-ecommerce::user.admin-user-create') }}
                </a>

        </div>
        {!! $dataGrid->render() !!}
    </div>
@stop