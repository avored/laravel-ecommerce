@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title"><h3>Create Category</h3></div>
                {!! Form::open(['route' => 'admin.category.store']) !!}
                @include('admin.catalog.category._fields')
                @include('template.submit',['label' => 'Create Category'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection