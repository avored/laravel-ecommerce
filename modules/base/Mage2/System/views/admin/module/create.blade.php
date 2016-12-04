@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload Module
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['method' => 'post','action' => route('admin.module.store'),'files' => true]) !!}
                        {!! Form::file('module_zip_file', 'Upload Module') !!}
                        {!! Form::submit('Upload Module') !!}

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection