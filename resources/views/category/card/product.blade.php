@php
$product->main_image_url = $product->main_image_url;
@endphp

<product-card 
    :product="{{ $product }}"
    add-to-cart-url="{{ route('add.to.cart') }}"
    add-to-wishlist="{{ route('wishlist.store') }}"
    :user-wishlists="{{ $wishlists }}"
    remove-from-wishlist="{{ route('wishlist.destroy') }}"
    product-page-url="{{ route('product.show', $product->slug) }}"
    currency="{{ session()->get('default_currency')->symbol }}">
</product-card>
