@extends('mage2-ecommerce::admin.layouts.app')
@section('content')
    <div class="container">
        <div class="h1">
            Admin Users

                <a href="{{ route('admin.admin-user.create') }}"
                   class="float-right btn btn-primary">
                    Create Admin User
                </a>

        </div>
        {!! $dataGrid->render() !!}
    </div>
@stop