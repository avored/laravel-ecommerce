@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Create Page
                        <!--<small>Sub title</small> -->
                    </h1>
                </div>
                {!! Form::open(['route' => 'admin.page.store']) !!}
                    @include('admin.page._fields')
                    @include('template.submit',['label' => 'Create Page'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection