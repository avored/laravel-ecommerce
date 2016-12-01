@extends('layouts.admin')

@section('content')
<div class="row">
    @if(count($configurations) <= 0)
    <p>Sorry No Configuration Found</p>
    @else
    
        @foreach($configurations as $configuration)
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{$configuration['title']}}</div>
                <div class="panel-body">
                    <p class="description">{{$configuration['description']}}</p>
                </div>
                <div class="panel-footer">
                    @can('hasPermission',[Mage2\User\Models\AdminUser::class, $configuration['edit_action']])
                        <a href="{{ route($configuration['edit_action']) }}">Edit</a>
                    @else
                        <span>Edit</span>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    
    @endif

</div>
@endsection