@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row profile">
        <div class="col-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">

                {!! Form::open(['action' => route('my-account.change-password.post'), 'method' => 'post']) !!}
                    {!! Form::password('current_password','Cuurent Password') !!}
                    {!! Form::password('password','New Password') !!}
                    {!! Form::password('password_confirmation','Password Confirmation') !!}
                    {!! Form::submit('Change My Password') !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
