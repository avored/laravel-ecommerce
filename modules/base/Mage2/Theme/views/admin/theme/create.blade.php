@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Theme
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => route('admin.theme.store'),'files' => true]) !!}
                        {!! Form::file('theme_zip_file', 'Upload Theme File') !!}
                        {!! Form::submit('Create Theme') !!}

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection