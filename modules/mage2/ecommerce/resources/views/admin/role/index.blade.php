@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="container">
        <div class="h1">
            Role List

                <a href="{{ route('admin.role.create') }}"
                   class="float-right btn btn-primary">
                    Create Role
                </a>

        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop