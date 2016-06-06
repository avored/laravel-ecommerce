@extends('layouts.polymer-app')

@section('content')


<h1>Categories</h1>
<div class="layout horizontal">
    <div class="flex-12">&nbsp;</div>
    <div class="flex-1">
        <a href="/admin/category/create">
        <paper-fab icon="add"></paper-fab>
        </a>
    </div>
</div>


<div class="container">
    <div class="header layout horizontal">

        <div class="flex-1"><strong>ID</strong></div>
        <div class="flex-1"><strong>Title</strong></div>
        
    </div>

    @foreach($categories as $category)
    <div class="product_row layout horizontal">
        <div class="flex-1">{{ $category->id }}</div>
        <div class="flex-1">{{ $category->title }}</div>
        
    </div>

    @endforeach


</div>
{!! $categories->render() !!}

@endsection
