@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrap">
        <span class="title"> Category List</span>
        <div class="pull-right" style="margin: 1rem 0px;">

            @can('hasPermission',[\Mage2\User\Models\AdminUser::class,'admin.category.create'])
            <a href="{{ route('admin.category.create') }}"
               class="btn btn-primary"> Create Category</a>
            @else
               <span class="btn btn-default" disabled>Create Category</span>
            @endcan
        </div>
        </div>
        <div class="clearfix"></div>
        <br/>
        @if(count($dataGrid->data) <= 0)

        <p>Sorry No Category Found</p>

        @else
                {!! $dataGrid->render() !!}
        @endif
    </div>
</div>
@endsection

