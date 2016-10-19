@extends('layouts.install')
@section('content')
    <div class="container">
        <div class="col s6 offset-s3">
            <div class="card card-default center-block">
                <div class="card-content">
                <div class="card-title">Welcome to Mage2 Installation</div>

                    <h2 class="text-center">Database Setup</h2>

                    {{ Form::open(['route' => 'mage2.install.database.post']) }}

                    <p>Click Continue to install Database</p>

                    <div class="col s12">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection