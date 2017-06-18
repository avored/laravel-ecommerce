@extends('layouts.admin')

@section('content')
    <div class="row">
        @foreach($configs as $config)
            <div class="col s4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">{{$config['title']}}</div>
                        <p class="description">{{$config['description']}}</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ $config['edit_action'] }}">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection