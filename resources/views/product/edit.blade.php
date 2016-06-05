@extends('layouts.polymer-app')

@section('content')

    <div class="row">
        <div class="col s12">
            <h1>Edit Products</h1>
            <form method="post" id="productEdit" action="/admin/product/{{$product->id}}">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="put"/>
                <input type="hidden" name="id" value="{{$product->id}}" />
                <paper-input autofocus autocomplete="true" value="{{ $product->title}}" required auto-validate error-message="Title is Required" 
                                name="title"label="Title"></paper-input>
                <paper-input autofocus autocomplete="true" value="{{ $product->price}}" required auto-validate error-message="Price is Required" 
                                name="price" label="Price"></paper-input>
                

                <paper-button onclick="document.getElementById('productEdit').submit();" raised class="indigo">Update</paper-button>
            </form>
        </div>
    </div>
@endsection
