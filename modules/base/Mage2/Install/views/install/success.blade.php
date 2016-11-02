@extends('layouts.install')

@section('content')

    <div class="col-md-6">
        <div class="panel panel-default panel-installation center-block">
            <div class="panel-heading"><h1>Welcome to Mage2 Ecommerce App Installation</h1></div>
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

@endsection