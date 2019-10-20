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
<product-page :product="{{ $product }}" :variations="{{ $product->getVariations() }}" inline-template>
<div>
  <a-row :gutter="15">
    <a-col :span="8">
      <a-card>
          <img class="product-main-image" :src="productMainImage" /> 
      </a-card>
    </a-col>
    <a-col :span="16">
      <h2 class="name">{{ $product->name }}</h2>

        @if ($product->type === 'BASIC') 
          @include('product.type.basic')
        @endif
        @if ($product->type === 'VARIABLE_PRODUCT') 
          @include('product.type.variable')
        @endif
    </a-col>
  </a-row>
  <a-row>
    <a-col>
      <div class="description">
          <div class="title">{{ __('Description') }}</div>
          <p>{!! $product->description !!}</p>
      </div>
    </a-col>
    <a-col>
      <div class="description">
          <div class="title">{{ __('Properties') }}</div>
          @php
            $properties = $product->getProperties();
          @endphp

          @if ($properties !== null && $properties->count() > 0)
            @foreach ($properties as $property)
                <p>{{ $property->name }}: {{ $property->getPropertyDisplayTextByProductId($product->id) }}</p>
            @endforeach
          @endif
      </div>
    </a-col>
  </a-row>
  <a-row>
    <a-col :span="24">
      <a-review
        product-id="{{ $product->id }}"
        :reviews="{{ $reviews }}"
        save-review-url="{{ route('review.save') }}">
      </a-review>
    </a-col>
  </a-row>
</div>
</product-page>

@endsection
