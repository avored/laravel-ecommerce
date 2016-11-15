@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12">
    <div class="main-title-wrap">
        <span class="title">
            Admin User List
            <!--<small>Sub title</small> -->
        </span>
        <div class="pull-right">


            @can('hasPermission',[\Mage2\User\Models\AdminUser::class,'admin.category.create'])
                <a  href="{{ route('admin.admin-user.create') }}"
                    class="btn btn-primary"> Create Admin User</a>
            @else
                <span class="btn btn-default" disabled>Create Admin User</span>
            @endcan
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

