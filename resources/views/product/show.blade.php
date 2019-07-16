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

      @if ($product->type === 'BASIC') 
        @include('product.type.basic')
      @endif
      @if ($product->type === 'VARIABLE_PRODUCT') 
        @include('product.type.variable')
      @endif
      <p>{!! $product->description !!}</p>
   
  </a-col>
</a-row>
</product-page>

@endsection
