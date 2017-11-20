@extends('layouts.app')

@section('meta_title', 'Register: Mage2 E commerce')
@section('meta_description', 'Register to Manage your Account for Mage2 E Commerce')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">

                        <div class="col-12">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           value="{{ old('first_name') }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="{{ old('last_name') }}" required autofocus>


                                </div>

                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>


                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>


                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>


                                </div>

                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
