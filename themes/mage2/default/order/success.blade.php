@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>Order Place Successfully!</h1>

            <a class="btn btn-primary" href="{{ route('my-account.home') }}">My Account</a>
            <a class="btn btn-primary" href="{{ route('home') }}">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection
