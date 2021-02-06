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
        <h1 class="text-red-700 mt-3 ml-5 text-2xl uppercase font-semibold">
          {{ $category->name }}
        </h1>
        <div class="block w-full">
            <div class="flex flex-wrap overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1">
                @foreach ($categoryProducts as $product)  
                    <div class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-1 md:px-1 md:w-1/3 lg:my-1 lg:px-1 lg:w-1/5 xl:my-1 xl:px-1 xl:w-1/4">
                        @include('category.card.product', ['product' => $product])
                    </div>
                @endforeach
            </div>
        
        </div>
      </div>
    </div>
  </div>
</category-page>
@endsection
