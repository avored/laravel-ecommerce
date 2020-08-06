
<div class="text-red-700 font-semibold text-xl">
    {{ session()->get('default_currency')->symbol }}{{ $product->getPrice() }}
</div>
<div class="text-xs">
    {{ __('Availability') }}: {{ $product->getQty() }}
</div>

<form method="post" class="pb-5 w-40" action="{{ route('add.to.cart') }}">
    @csrf

    <avored-input 
        input-type="number"
        init-value="1"
        field-name="qty">
    </avored-input>
    <button class="text-white mt-5 px-4 bg-red-500 border-0 py-2 
        focus:outline-none hover:bg-red-600 rounded text-lg">
        Add To Cart
    </button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
</form>
