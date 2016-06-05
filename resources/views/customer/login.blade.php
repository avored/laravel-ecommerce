@extends('layouts.polymer-app')

@section('content')

    <div class="flex-vertical">
        <div class="flex6child">

            <paper-card heading="Login">
                <div class="card-content">
                    <form id="loginForm" method="post" action="{{ url('/customer/login') }}">
                        {{ csrf_field() }}
                        <paper-input required auto-validate error-message="Email is Required" name="email"label="Email"></paper-input>
                        <paper-input required auto-validate error-message="Password is Required" name="password" type="password" label="Password"></paper-input>

                        <paper-checkbox name="remember" label="Remember Me"></paper-checkbox>
                        <p></p>
                        <paper-button
                                onclick="document.getElementById('loginForm').submit()"
                                raised class="custom indigo">Login
                        </paper-button>


                        <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>

                    </form>
                </div>
        </div>
    </div>
@endsection
