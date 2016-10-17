@extends('layouts.admin')


@section('content')
        <div class="row">

            <div class="main-title-wrapper">
                <div class="title">Create Order Status</div>
            </div>
            <div class="col s12">
                {!! Form::open(['route' => 'admin.order-status.store']) !!}
                    @include('admin.order-status._fields')
                    @include('template.submit',['label' => 'Create Order Status'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection