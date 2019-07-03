@extends('layouts.app')

@section('content')
<product-page inline-template>
<a-row :gutter="15">
  <a-col :span="8">
     <a-card>
        <img class="product-main-image" src="{{ $product->main_image_url }}" /> 
    </a-card>
  </a-col>
  <a-col :span="16">
    <h2>{{ $product->name }}</h2>  

      <form method="post" action="{{ route('add.to.cart') }}">
        @csrf

        <a-input-number :min="1" :default-value="1" @change="changeQty" name="qty"></a-input-number>
        <a-button html-type="submit" type="primary">
          <a-icon type="shopping_cart"></a-icon>
          Add To Cart
        </a-button>
        <input type="hidden" name="slug" value="{{ $product->slug }}" />
        <input type="hidden" name="qty" v-model="qty" />

      </form>  
      <p>{!! $product->description !!}</p>
   
  </a-col>
</a-row>
</product-page>

@endsection
