@extends('layouts.app')

@section('meta_title','Edit My Account E commerce')
@section('meta_description','Edit My Account E commerce')


@section('content')
    <div class="container">
        <div class="row profile">

            <div class="col-2">
                @include('user.my-account.sidebar')
            </div>
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        Profile Edit
                    </div>
                    <div class="card-body">
                        <div class="profile-content">

                            <form method="post" action="{{ route('my-account.store') }}">
                                {{ csrf_field() }}

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" class="form-control" type="text" value="{{ $user->first_name }}"
                                       name="first_name">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" value="{{ $user->last_name}}"
                                       name="last_name">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" disabled="true"
                                       value="{{ $user->email }}"
                                       name="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone">Phone</label>
                                    <input id="phone" type="text" class="form-control"
                                           value="{{ $user->phone }}"
                                           name="phone">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                    <label for="company_name">Company Name</label>
                                    <input id="company_name" type="text" class="form-control"
                                           value="{{ $user->company_name }}"
                                           name="company_name">
                                    @if ($errors->has('company_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Update Profile</button>

                            </div>


                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
