@extends('mage2::layouts.admin')

@section('header-title')
<h1>
    OrderStatus List
    <!--<small>Sub title</small> -->
</h1>
@endsection
@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">OrderStatus</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col s12">
        <div class="pull-right">
            <a href="{{ route('admin.order-status.create') }}"
               class="btn btn-primary"> Create Order Status</a>
        </div>
        <div class="clearfix"></div>
        <br/>
        @if(count($orderStatuses) <= 0)

        <p>Sorry No Order Statuses Found</p>

        @else
        <table class="table table-bordered table-responsive">
            <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Is Default</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($orderStatuses as $orderStatus)
                <tr>

                    <td>{{ $orderStatus->id }}</td>
                    <td>{{ $orderStatus->title }}</td>

                    <td>{{ ($orderStatus->is_default == 1) ? "Yes" : "No" }}</td>

                    <td>
                        <a href="{{ route('admin.order-status.edit',$orderStatus->id )}}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.order-status.destroy',$orderStatus->id]]) !!}
                        <a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection

