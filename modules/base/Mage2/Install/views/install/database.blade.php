@extends('layouts.install')
@section('content')

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Mage2 Installation</div>
                <div class="panel-body">


                    <h2 class="text-center">Database Setup</h2>

                    {!! Form::open(['method' => 'post','action' => route('mage2.install.database.post')]) !!}

                    <p>Click Continue to install Database</p>

                    <div class="col s12">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

@endsection