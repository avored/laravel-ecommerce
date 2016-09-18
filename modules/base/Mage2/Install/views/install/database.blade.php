@extends('layouts.install')
@section('content')
    <div class="container">
        <div class="col s6 col-md-offset-3">
            <div class="panel panel-default panel-installation center-block">
                <div class="panel-heading">Welcome to Mage2 Installation</div>
                <div class="panel-body">
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