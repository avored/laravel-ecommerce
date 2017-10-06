@extends('mage2-framework::layouts.admin')

@section('content')
    <div class="container">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Upload Module
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'post','action' => route('admin.module.store'),'files' => true]) !!}
                    {!! Form::file('module_zip_file', 'Upload Module') !!}
                    {!! Form::submit('Upload Module') !!}

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection