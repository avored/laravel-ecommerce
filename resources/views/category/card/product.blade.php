@php
$product->main_image_url = empty($product->mainImage) ? 'https://placehold.it/250x250' : asset('storage/'.$product->mainImage->path);
@endphp

<div class="max-w-xs bg-white border shadow-lg rounded-lg overflow-hidden my-10">
  
  <img class="h-56 w-full object-cover" src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
  <div class="px-4 my-4 py-2">
    <h1 class="text-gray-800 font-semibold text-xl">{{ $product->name }}</h1>
    <p class="text-gray-500 text-xs">{{ number_format($product->qty, 0) }} in Stock</p>
  </div>
  <div class="flex items-center justify-between px-4 py-2 bg-gray-300">
    <h1 class="font-semibold text-xl">{{ session()->get('default_currency')->symbol . number_format($product->price, 2) }}</h1>
    <button class="px-3 py-1 bg-red-500 text-white text-sm font-semibold rounded">Add to cart</button>
  </div>
</div>
