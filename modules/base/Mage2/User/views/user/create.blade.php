@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Create User
                        <!--<small>Sub title</small> -->
                    </h1>
                </div>
                {!! Form::open(['route' => 'admin.user.store']) !!}
                    @include('user._fields')
                    @include('template.submit',['label' => 'Create User'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection