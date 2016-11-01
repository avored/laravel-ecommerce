@extends('layouts.admin')

@section('content')
<div class="row">
    @foreach($configurations as $configuration)
    <div class="col s4">
        <div class="card">
            <div class="card-content">
                <div class="card-title">{{$configuration['title']}}</div>
                <p class="description">{{$configuration['description']}}</p>
            </div>
                <div class="card-action">
                    <a href="{{ $configuration['edit_action'] }}">Edit</a>
                </div>
        </div>
    </div>
    @endforeach

</div>
@endsection