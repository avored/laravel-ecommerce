@extends('layouts.install')

@section('content')

    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default panel-installation center-block">
                <div class="panel-heading">Welcome to Mage2 Ecommerce App Installation</div>
                <div class="panel-body">
                    <h4>
                        You have successfully install!
                    </h4>
                    <p>
                        <a href="{{ route('admin.login') }}" class="btn btn-primary">Admin Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection