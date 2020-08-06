@extends('layouts.app')

@section('breadcrumb')
<div style="margin: 16px 0">
    <div>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </div>
    <div>
        {{ $product->name }}
    </div>
</div>
@endsection

@section('content')
<product-page :product="{{ $product }}" :variations="{{ $product->getVariations() }}" inline-template>
<div class="container mx-auto">

    
    @if (session('type') === 'success')
      @include('components.success', ['message' => session('message')])
    @endif
    @if (session('type') === 'error')
      @include('components.error', ['message' => session('message')])
    @endif
   
  <div class="flex pb-6">
    
    <div class="w-1/3">
      
      <div class="rounded object-cover border">
          <img class="product-main-image" :src="productMainImage" /> 
      </div>
    </div>
    <div class="w-2/3 ml-5">
      <h2 class="text-semibold text-red-700 text-2xl py-6">{{ $product->name }}</h2>

        @if ($product->type === 'BASIC') 
          @include('product.type.basic')
        @endif
        @if ($product->type === 'VARIABLE_PRODUCT') 
          @include('product.type.variable')
        @endif
    </div>
  </div>
  <div class="rounded border p-6">
    <div>
      <div class="description">
          <div class="text-semibold text-red-700 text-2xl border-b py-6">{{ __('Description') }}</div>
          <p class="mt-5">{!! $product->description !!}</p>
      </div>
    </div>
    <div>
      <div class="description">
          <div class="text-semibold text-red-700 text-2xl py-6">{{ __('Properties') }}</div>
          <div class="mt-5">
            @php
              $properties = $product->getProperties();
            @endphp
            @if ($properties !== null && $properties->count() > 0)
              @foreach ($properties as $property)
                  <p>{{ $property->name }}: {{ $property->getPropertyDisplayTextByProductId($product->id) }}</p>
              @endforeach
            @endif
          </div>
      </div>
    </div>
  </div>
</div>
</product-page>

@endsection
