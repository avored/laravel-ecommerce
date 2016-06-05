@extends('layouts.polymer-app')

@section('content')


<h1>Products</h1>
<div class="layout horizontal">
    <div class="flex-12">&nbsp;</div>
    <div class="flex-1">
        <a href="/admin/product/create">
        <paper-fab icon="add"></paper-fab>
        </a>
    </div>
</div>

<div class="container">
    <div class="header layout horizontal">

        <div class="flex-1"><strong>ID</strong></div>
        <div class="flex-1"><strong>Title</strong></div>
        <div class="flex-1"><strong>Price</strong></div>
        <div class="flex-1">

        </div>
    </div>

    @foreach($products as $product)
    <div class="product_row layout horizontal">
        <div class="flex-1">{{ $product->id }}</div>
        <div class="flex-1">{{ $product->title }}</div>
        <div class="flex-1">{{ $product->price }}</div>
        <div class="flex-1">
            <a href="/admin/product/{{ $product->id }}/edit">Edit</a>
            <form action="/admin/product/{{$product->id}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE" >
                <button type="submit">Delete</button>

            </form>


        </div>
    </div>

    @endforeach


</div>
{!! $products->render() !!}

@endsection
