@extends('layouts.app')

@section('content')
    <div class="row profile">
        <div class="col-md-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-10">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Change Password
                </div>
                <div class="panel-body">
                    <?php
                    //dd($errors);
                    ?>
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
@endsection
