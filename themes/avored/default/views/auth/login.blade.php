@extends('layouts.app')

@section('meta_title', 'Login: AvoRed E commerce')
@section('meta_description', 'My Account Management System for AvoRed E Commerce')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h3>Reasons to create an account</h3>
                            <ul class="">
                                <li class="auth-item">Manage all your orders and returns in one place. </li>
                                <li class="auth-item">Order faster with your saved address information </li>
                                <li class="auth-item">You can access your shopping cart on any device. </li>
                            </ul>
                            <div class="clearfix">&nbsp;</div>

                            <a href="{{ url('register') }}" class="btn btn-success">{{ __('auth.create') }}</a>
                        </div>

                        <div class="col">
                            <h3>{{ __('auth.signin_title') }}</h3>
                          <form method="POST" action="{{ route('login.post') }}"> 
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email">{{ __('auth.email') }}</label>
                                <input id="email" type="email" name="email"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('auth.password') }}</label>
                                <input type="password" name="password" id="password"  class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input id="rememberme" type="checkbox" name="remember"/> {{ __('auth.remember') }}
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('auth.login') }}</button>
                                <a href="{{ url('/password/reset') }}" class="">{{ __('auth.reset_password') }}</a>
                                @if($errors->has('enableResendLink'))
                                    <div class="form-group">
                                        <a class="" href="{{ route('user.activation.resend') }}">Resend Activation Email</a>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="footer-social-icons">
                                    <h4>{{ __('auth.social_auth') }}</h4>
                                    <ul class="social-icons">
                                        <li><a href="{{ route('login.provider', 'facebook') }}" class="social-icon"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="{{ route('login.provider', 'google') }}" class="social-icon"><i class="fab fa-google"></i></a></li>
                                        <li><a href="{{ route('login.provider', 'twitter') }}"" class="social-icon"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection