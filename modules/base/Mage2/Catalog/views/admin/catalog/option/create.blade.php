@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="main-title-wrap">
                    <span class="title">
                        Create Product Option
                    </span>
                </div>
                {!! Form::open(['method' => 'post','action' => route('admin.option.store')]) !!}
                    @include('admin.catalog.option._fields')
                    {!! Form::submit('Create Option') !!}
                {!! Form::close() !!}
            </div>
        </div>
@endsection