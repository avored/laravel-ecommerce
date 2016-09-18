@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col s12">
            <h2>Checkout Page</h2>
            <div class="account-wrapper">
                <div class="col s6 col-sm-12">
                    <div class="card card-default">
                        <div class="card-content">
                        <div class="card-title">Create Account</div>
                            {!! Form::open(['url' => '/checkout/step/user','method' => 'post']) !!}

                            <div class="input-field{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" >First Name</label>
                                <input id="first_name" type="text"  name="first_name" value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="input-field{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" >Last Name</label>
                                <input id="last_name" type="text"  name="last_name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" >Email</label>

                                <input id="email" type="email"  name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" >Password</label>
                                <input id="password" type="password"  name="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="input-field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation" >Confirm Password</label>
                                <input id="password_confirmation" type="password"  name="password_confirmation" value="">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="input-field">
                                {!! Form::submit("Register",['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
                <div class="col s6">
                    <div class="card card-default">
                        <div class="card-content">
                        <div class="card-title">Login</div>
                            {!! Form::open(['url' => '/login','method' => 'post']) !!}


                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="login-email" >Email</label>

                                <input id="login-email" type="email"  name="email" value="">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="login-password" >Password</label>
                                <input id="login-password" type="password"  name="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>


                            <input type="hidden" name="page" value="checkout" />
                            <div class="input-field">
                                {!! Form::submit("Login",['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection