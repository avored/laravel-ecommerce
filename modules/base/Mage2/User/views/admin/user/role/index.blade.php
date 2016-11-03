@extends('layouts.admin-bootstrap')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="main-title-wrap">
        <span class="title">Role List</span>
        <div class="pull-right">
            <a href="{{ route('admin.role.create') }}"class="btn btn-primary"> Create Role</a>
        </div>

    </div>

        @if(count($dataGrid->data) <= 0)

        <p>Sorry No Role Found</p>

        @else
            {!! $dataGrid->render() !!}
        @endif
    </div>
</div>
@endsection

