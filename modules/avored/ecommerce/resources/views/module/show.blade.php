@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="row mt-3">

        <div class="col-12">
            <div class="h1 float-left">
                {{  __($module->name()) }}
            </div>
        
           
        </div>
    </div>
    <div class="row">
       
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="h5">{{ $module->name() }}</div>
                    <p>{{ $module->description() }}</p>
                    <a href="{{ route('admin.module.create') }}"
                   class="btn btn-primary">
                    Migrate
                </a>
                <a href="{{ route('admin.module.create') }}"
                   class="btn btn-primary">
                    Publish Files
                </a>
                </div>
                
            </div>
        </div>
           

    </div>

@endsection

