@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2>Checkout Page</h2>
            <div class="account-wrapper">
                <div class="col-md-6 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Create Account</div>
                        <div class="panel-body">
                            {!! Form::open(['url' => '/checkout/step/user','method' => 'post']) !!}

                            @include('template.text',['key' => 'first_name','label' => 'First Name'])
                            @include('template.text',['key' => 'last_name','label' => 'Last Name'])
                            @include('template.text',['key' => 'email','label' => 'Email'])
                            @include('template.password',['key' => 'password','label' => 'Password'])
                            @include('template.password',['key' => 'password_confirmation','label' => 'Confirm Password'])

                            @include('template.submit',['label' => 'Register'])

                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                            {!! Form::open(['url' => '/login','method' => 'post']) !!}

                            @include('template.text',['key' => 'email','label' => 'Email'])
                            @include('template.password',['key' => 'password','label' => 'Password'])
                            <input type="hidden" name="page" value="checkout" />
                            @include('template.submit',['label' => 'Login'])

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection