@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="row mt-3">

        <div class="col-12">
            <div class="h1 float-left">
                {{  __('avored-ecommerce::module.module-list') }}
            </div>
        
            <div class="float-right">
                <a href="{{ route('admin.module.create') }}"
                   class="btn btn-primary">
                    {{  __('avored-ecommerce::module.module-upload') }}
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        @if(count($modules) <= 0)
            <p>Sorry No Modules Found</p>
        @else
            @foreach($modules as $module)
                <div class="col-3 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="http://placehold.it/250x250" alt="Card image cap">

                        <div class="card-body">
                            <div class="h5">{{ $module->name() }}</div>
                            <p>{{ $module->description() }}</p>
                            <a href="{{ route('admin.module.show', $module->identifier() ) }}"  class="btn btn-primary card-link">View</a>
                        </div>
                        
                    </div>
                </div>
            @endforeach

        @endif

    </div>

@endsection

