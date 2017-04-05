@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="main-title-wrap">
        <span class="title">
            Page List
            <!--<small>Sub title</small> -->
        </span>
        <div class="pull-right" style="margin: 1rem 0px;">

            @can('hasPermission',[\Mage2\User\Models\AdminUser::class,'admin.page.create'])
            <a href="{{ route('admin.page.create') }}"
               class="btn btn-primary"> Create Page</a>
            @else
                <span class="btn btn-default" disabled>Create Page</span>
                @endcan
        </div>

    </div>


        <div class="clearfix"></div>
        <br/>
        @if(count($dataGrid->data) <= 0)

        <p>Sorry No Page Found</p>

        @else
        {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

