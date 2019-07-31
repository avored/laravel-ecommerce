@extends('layouts.app')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </a-breadcrumb-item>
    <a-breadcrumb-item>
        {{ $product->name }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection

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
