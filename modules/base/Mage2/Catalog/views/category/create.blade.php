@extends('layouts.admin')


@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Create Category</h3></div>
                    <div class="card-block">
                {!! Form::open(['route' => 'admin.category.store']) !!}
                    @include('category._fields')
                    @include('template.submit',['label' => 'Create Category'])
                    
                {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection