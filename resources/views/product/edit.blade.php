@extends('layouts.admin.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <h1>Edit Products</h1>
            <form method="post" action="/admin/product/{{$product->id}}">
                <div class="input-field">
                    <input placeholder="" id="product_title_text" value="{{ $product->title }}" autofocus type="text" name="title" />
                    <label for="product_title_text">Title</label>
                </div>
                <div class="input-field">
                    <input id="product_price_text" type="text" value="{{ $product->price }}" name="price" />
                    <label for="product_price_text">Price</label>
                </div>

                <div class="input-field">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="put"/>
                    <input type="hidden" name="id" value="{{$product->id}}" />
                    <button name="update" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
