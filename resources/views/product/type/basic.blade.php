
<div class="text-red-700 font-semibold text-xl">
    {{ session()->get('default_currency')->symbol }}{{ $product->getPrice() }}
</div>

@if ($product->qty > 0)
    <div class="text-xs">
        {{ __('avored.availability') }} {{ number_format($product->qty, 0) }}
    </div>
@else 
    <div class="text-xs">
        {{ __('avored.not_available') }}
    </div>
@endif
<div class="flex items-end">
<form method="post" class="pb-5 w-40" action="{{ route('add.to.cart') }}">
    @csrf

    <avored-input 
        input-type="number"
        init-value="1"
        field-name="qty">
    </avored-input>
    <button class="text-white mt-5 px-4 bg-red-500 border-0 py-2 
        focus:outline-none hover:bg-red-600 rounded text-lg">
        {{ __('avored.add_to_cart') }}
    </button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
</form>

<?php 
    $wishlistRepository = app(\AvoRed\Wishlist\Database\Contracts\WishlistModelInterface::class);
    $customer = auth()->guard('customer')->user();
?>
@if (($customer === null) ||  !($customer && $wishlistRepository->customerHasProduct($customer, $product->id)))

<form method="post" class="pb-5 w-40" action="{{ route('wishlist.store') }}">
    @csrf
    <button class="text-white mt-5 px-4 bg-gray-500 border-0 py-2 
        focus:outline-none hover:bg-gray-700 leading-7 rounded text-xs">
            {{ __('avored.add_to_wishlist') }}
    </button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
</form>
@else 
<form method="post" class="pb-5 w-56" action="{{ route('wishlist.destroy') }}">
    @csrf
    <button class="text-white mt-5 px-4 bg-gray-500 border-0 py-2 
        focus:outline-none hover:bg-gray-700 leading-7 rounded text-xs">
            {{ __('avored.remove_to_wishlist') }}
    </button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
</form>
@endif

</div>
