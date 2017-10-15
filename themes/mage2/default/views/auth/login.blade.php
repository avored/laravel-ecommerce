@extends('layouts.app')

@section('meta_title', 'Login: Mage2 E commerce')
@section('meta_description', 'My Account Management System for Mage2 E Commerce')


@section('content')
    <div class="row mt-4 mb-4 justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header"><span>Mage2 Login</span></div>
                <div class="card-body">
                    <div class="col-12">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('login.post') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>


                                <input id="email" type="email" name="email" class="form-control"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="checkbox">
                                <label>
                                    <input id="rememberme" type="checkbox" name="remember"/>
                                    Remember Me
                                </label>
                            </div>

                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                                <a class="" href="{{ url('register') }}">
                                    Create an Account
                                </a>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
