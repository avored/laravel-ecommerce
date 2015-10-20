@extends('admin.master')

@section('content')

    <div class="content">
        <h1>Edit User Account</h1>

        <div class="edit_account_form">
            {!! Form::model($user,array('method' => 'PATCH', 'url' => url('/admin/user/edit-account')) ) !!}

            @include('admin.user._edit')

            {!! Form::close() !!}

        </div>

    </div>

@endsection
