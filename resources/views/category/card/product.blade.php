@php
$product->main_image_url = $product->main_image_url;
@endphp

<product-card 
    :product="{{ $product }}"
    add-to-cart-url="{{ route('add.to.cart') }}"
    product-page-url="{{ route('product.show', $product->slug) }}"
    currency="{{ session()->get('default_currency')->symbol }}">
</product-card>
