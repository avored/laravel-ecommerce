@extends('layouts.admin-bootstrap')

@section('content')
<div class="row">
    <div class="col s12">
    <div class="main-title-wrap">
        <span class="title">
            Admin User List
            <!--<small>Sub title</small> -->
        </span>
        <div class="pull-right">
            <a href="{{ route('admin.admin-user.create') }}"
               class="btn btn-primary"> Create Admin User</a>
        </div>
    </div>

        @if(count($dataGrid->data) <= 0)
        <p>Sorry No User Found</p>
        @else
         {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

