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

                    <form action="{{ route('my-account.change-password.post') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Change My Password</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
