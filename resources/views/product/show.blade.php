@extends('layouts.app')

@section('breadcrumb')
<div class="bg-gray-200 p-3 rounded text-sm mb-5">
    <ol class="list-reset flex text-gray-700">
      <li>
          <a class=" font-semibold" href="{{ route('home') }}">
              {{ __('avored.home') }}
          </a>&nbsp; > &nbsp;
      </li>
       <li> <span class="">{{ $product->name }}</span></li>
    </ol>
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

      <div class="rounded border">
          <div class="text-semibold p-3 text-red-700 text-2xl border-b">
              {{ __('Description') }}
          </div>
          <p class="p-5">{!! $product->description !!}</p>
      </div>
    
      <div class="mt-5 rounded border">
          @php
            $properties = $product->getProperties();
          @endphp
          <div class="text-semibold p-3 border-b text-red-700 text-2xl">
            {{ __('avored.properties') }}
          </div>
          <div class="p-5">
              @if ($properties !== null && $properties->count() > 0)
                @foreach ($properties as $property)
                    <p>{{ $property->name }}: {{ $property->getPropertyDisplayTextByProductId($product->id) }}</p>
                @endforeach
              @endif
          </div>
        </div>
        @include('avored-review::product.review')
  </div>
</product-page>

@endsection
