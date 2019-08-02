
<div class="price">
    {{ session()->get('default_currency')->symbol }}{{ $product->getPrice() }}
</div>
<div class="availability">
    {{ __('Availability') }}: {{ $product->getQty() }}
</div>

<form method="post" action="{{ route('add.to.cart') }}">
    @csrf

    <a-input-number :min="1" :default-value="1" @change="changeQty" name="qty"></a-input-number>
    <a-button html-type="submit" type="primary">
        <a-icon type="shopping_cart"></a-icon>
        Add To Cart
    </a-button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
    <input type="hidden" name="qty" v-model="qty" />
</form>
