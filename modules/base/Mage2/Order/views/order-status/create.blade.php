@extends('mage2::layouts.admin')

@section('header-title')
<h1>
    Create Order Status
    <!--<small>Sub title</small> -->
</h1>
@endsection

@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{ route('admin.order-status.index') }}"><i class="fa fa-link"></i>OrderStatus</a></li>
        <li class="active">Create</li>
    </ol>
@endsection


@section('content')
        <div class="row">

            <div class="col s12">
                {!! Form::open(['route' => 'admin.order-status.store']) !!}
                    @include('mage2::order-status._fields')
                    @include('mage2::template.submit',['label' => 'Create Order Status'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection