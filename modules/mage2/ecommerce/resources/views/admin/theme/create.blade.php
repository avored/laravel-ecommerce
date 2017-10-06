@extends('mage2-framework::layouts.admin')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Upload Theme
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'post','action' => route('admin.theme.store'),'files' => true]) !!}
                    {!! Form::file('theme_zip_file', 'Upload Theme File') !!}
                    {!! Form::submit('Upload Theme') !!}

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection