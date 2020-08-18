@extends('layouts.app')


@section('breadcrumb')
      
<div class="flex mb-2">
    <div>
      <a href="{{ route('home') }}" class="text-sm text-gray-700" title="home">
        {{ __('Home') }} >> 
      </a>
    </div>
    <div class="ml-1 text-sm text-gray-700">
        {{ $category->name }}
    </div>
</div>
@endsection

@section('content')
<category-page
  current-url="{{ request()->url() }}"
  :filter-prop="{{ json_encode(request()->all()) }}"
  inline-template>
  
  <div class="flex container mx-auto">
    <div class="w-1/6">
      @include('category.card.filters')
    </div>
    <div class="w-5/6 ml-3">
      <h1 class="text-red-700 mt-3 ml-5 text-2xl uppercase font-semibold">{{ $category->name }}</h1>
      <div class="block">
        <div class=" flex flex-wrap">
          @foreach ($categoryProducts as $product)  
            @include('category.card.product', ['product' => $product])
          @endforeach
        </div>
      </div>
    </div>
  </div>
</category-page>
@endsection
