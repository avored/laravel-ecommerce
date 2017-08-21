@extends('layouts.app')

@section('meta_title')
    {{ $page->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>{{ $page->title }}</h1>

            <p>{!!  $page->content !!}</p>
        </div>
    </div>
@endsection
