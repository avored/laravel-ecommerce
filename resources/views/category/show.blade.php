@extends('layouts.app')


@section('breadcrumb')
<div class="bg-gray-200 p-3 rounded text-sm mb-5">
    <ol class="list-reset flex text-gray-700">
      <li>
          <a class=" font-semibold" href="{{ route('home') }}">
              {{ __('avored.home') }}
          </a>&nbsp; > &nbsp;
      </li>
       <li> <span class="">{{ $category->name }}</span></li>
    </ol>
</div>
@endsection

@section('content')
<category-page
  current-url="{{ request()->url() }}"
  :filter-prop="{{ json_encode(request()->all()) }}"
  inline-template>
  <div>
      @if (session('type') === 'success')
        @include('components.success', ['message' => session('message')])
      @endif
      @if (session('type') === 'error')
        @include('components.error', ['message' => session('message')])
      @endif
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
  </div>
</category-page>
@endsection
