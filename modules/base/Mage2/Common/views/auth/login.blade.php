@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="card card-default">
                    <div class="card-content">
                        <div class="card-title"><h5>Mage2 Login</h5></div>
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('login.post') }}">
                            {{ csrf_field() }}

                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col s4 control-label">E-Mail Address</label>


                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                            </div>

                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col s4 control-label">Password</label>


                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                            </div>

                            <div class="">
                                <p>
                                    <input id="rememberme" type="checkbox" name="remember" />
                                    <label for="rememberme">Remember Me</label>
                                </p>
                            </div>


                            <div class="input-field">

                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <!--a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                                    Forgot Your Password?
                                </a-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
