@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Checkout Page</h2>
            @if(count($cartProducts) <= 0)
                <p>Sorry No Product Found</p>
                <p> <a href="{{ route('home') }}">Start Shopping</a> </p>
            @else
                <div class="account-wrapper">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Create Account</div>
                        <div class="panel-body">
                            {!! Form::open(['action' => '/checkout/step/user','method' => 'post']) !!}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" >First Name</label>
                                <input id="first_name" class="form-control" type="text"  name="first_name" value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" >Last Name</label>
                                <input id="last_name" class="form-control" type="text"  name="last_name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" >Email</label>

                                <input id="email" class="form-control" type="email"  name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" >Password</label>
                                <input id="password" class="form-control" type="password"  name="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation" >Confirm Password</label>
                                <input id="password_confirmation" class="form-control" type="password"  name="password_confirmation" value="">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="form-group">
                                {!! Form::submit("Register") !!}
                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <div class="panel-heading">Login</div>
                            {!! Form::open(['action' => '/login','method' => 'post']) !!}


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="login-email" >Email</label>

                                <input id="login-email" class="form-control" type="email"  name="email" value="">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="login-password" >Password</label>
                                <input id="login-password" class="form-control" type="password"  name="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>


                            <input type="hidden" name="page" value="checkout" />
                            <div class="form-group">
                                {!! Form::submit("Login",['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection