@extends('layouts.install')
@section('content')
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default panel-installation center-block">
                <div class="panel-heading">Welcome to Crazy Installation</div>
                <div class="panel-body">
                    <h2 class="text-center">Database Setup</h2>

                    {{ Form::open(['route' => 'crazy.install.database.post']) }}

                    <p>Click Continue to install Database</p>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection