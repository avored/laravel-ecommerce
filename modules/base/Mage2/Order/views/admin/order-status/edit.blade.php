@extends('mage2::layouts.admin')
@section('header-title')
<h1>
    Edit Order Status
    <!--<small>Sub title</small> -->
</h1>
@endsection
@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{ route('admin.order-status.index') }}"><i class="fa fa-link"></i>Order Status</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection
@section('content')
        <div class="row">
            <div class="col s12">

                {!! Form::bind($orderStatus, ['method' => 'PUT', 'action' => route('admin.order-status.update', $orderStatus->id)]) !!}
                        @include('admin.order-status._fields')
                    
                {!! Form::submit('Update Order Status') !!}
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection