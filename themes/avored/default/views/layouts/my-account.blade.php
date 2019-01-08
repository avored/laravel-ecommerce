@extends('layouts.app')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('content')
<div id="myaccount-page-content">
    <div class="container">
        <div class="myaccount-text-wrapper">
            <div class="row">
                <div class="col-3">
                    @include('user.my-account.sidebar')
                </div>

                <div class="col-9">
                    <div class="myaccount-content">
                        @yield('account-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
