@php
$product->main_image_url = empty($product->mainImage) ? 'https://placehold.it/250x250' : asset('storage/'.$product->mainImage->path);
@endphp
<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
  <div class="max-w-xs bg-white border shadow-lg rounded-lg overflow-hidden ml-3 my-10">
    <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
        <img class="h-56 w-full object-cover" src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
    </a>
    <div class="px-4 my-4 py-2">
      <h1 class="text-gray-800 font-semibold text-xl">{{ $product->name }}</h1>
      <p class="text-gray-500 text-xs">{{ number_format($product->qty, 0) }} in Stock</p>
    </div>
    <div class="flex items-center justify-between px-4 py-2 bg-gray-300">
      <h1 class="font-semibold text-xl">{{ session()->get('default_currency')->symbol . number_format($product->price, 2) }}</h1>
        <form  method="post" action="{{ route('add.to.cart') }}">
            @csrf
            <input type="hidden" name="slug" value="{{ $product->slug }}" />
            <input type="hidden" name="qty" value="1" />
            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-semibold rounded">
                Add to cart
            </button>
        </form>
    </div>
  </div>
</div>
