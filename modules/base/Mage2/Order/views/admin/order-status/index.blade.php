@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="main-title-wrap">
            <span class="title"> Order Status List</span>
            <div class="pull-right">
                <a href="{{ route('admin.order-status.create') }}" class="btn btn-primary">Create Order Status</a>
            </div>
        </div>

        @if(count($dataGrid->data) <= 0)

        <p>Sorry No Order Status Found</p>

        @else
            {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

