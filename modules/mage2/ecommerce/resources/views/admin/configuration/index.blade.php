@extends('mage2-ecommerce::admin.layouts.app')

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
                                <a href="{{ route($configuration['edit_action']) }}">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif

        </div>
    </div>
@endsection