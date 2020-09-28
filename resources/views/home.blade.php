@extends('layouts.app')

@section('breadcrumb')
<div class="bg-gray-200 p-3 rounded text-sm mb-5">
    <ol class="list-reset flex text-gray-700">
       <li> <span class="">{{ __('avored.home') }}</span></li>
    </ol>
</div>
@endsection

@section('content')
  <div class="container m-auto">
      @if (session('type') === 'success')
        @include('components.success', ['message' => session('message')])
      @endif
      @if (session('type') === 'error')
        @include('components.error', ['message' => session('message')])
      @endif

      @if ($page)
        {!! $page->getContent() !!}
      @endif

    <h1 class="text-2xl my-5 text-red-700">{{ __('AvoRed Special Week') }}</h1>
    <div class="block">
      <div class="flex flex-wrap">
          @foreach ($products as $product)
              @include('category.card.product', ['product' => $product])
          @endforeach
        </div>
    </div>
</div>
@endsection
