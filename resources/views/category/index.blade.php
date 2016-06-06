@extends('layouts.polymer-app')

@section('content')


<h1>Pages</h1>
<div class="layout horizontal">
    <div class="flex-12">&nbsp;</div>
    <div class="flex-1">
        <a href="/admin/page/create">
        <paper-fab icon="add"></paper-fab>
        </a>
    </div>
</div>


<div class="container">
    <div class="header layout horizontal">

        <div class="flex-1"><strong>ID</strong></div>
        <div class="flex-1"><strong>Title</strong></div>
        <div class="flex-1"><strong>Slug</strong></div>
        
    </div>

    @foreach($pages as $page)
    <div class="product_row layout horizontal">
        <div class="flex-1">{{ $page->id }}</div>
        <div class="flex-1">{{ $page->title }}</div>
        <div class="flex-1">{{ $page->slug }}</div>
        
    </div>

    @endforeach


</div>
{!! $pages->render() !!}

@endsection
