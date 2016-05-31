@extends('layouts.admin.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <h1>Create Products</h1>
            <form method="post" action="/admin/product">
                <div class="input-field">
                    <input placeholder="" id="product_title_text" autofocus type="text" name="title" />
                    <label for="product_title_text">Title</label>
                </div>
                <div class="input-field">
                    <input id="product_price_text" type="text" name="price" />
                    <label for="product_price_text">Price</label>
                </div>

                <div class="input-field">
                    {!! csrf_field() !!}
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
