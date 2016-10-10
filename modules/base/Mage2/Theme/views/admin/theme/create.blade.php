@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Create Theme
                        <!--<small>Sub title</small> -->
                    </h1>
                </div>
                {!! Form::open(['route' => 'admin.theme.store','files' => true]) !!}
                    @include('template.file',['key' => 'theme_zip_file','label' => 'Upload Theme File'])

                    @include('template.submit',['label' => 'Create Theme'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection