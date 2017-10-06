@extends('mage2-framework::layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            @if(count($configurations) <= 0)
                <p>Sorry No Configuration Found</p>
            @else

                @foreach($configurations as $configuration)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">{{$configuration['title']}}</div>
                            <div class="card-body">
                                <p class="description">{{$configuration['description']}}</p>
                            </div>
                            <div class="card-footer">
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
    </div>
@endsection