<div class="panel panel-primary">
    <div class="panel-body">

        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->title }}">
            @include('catalog.product.view.product-image',['product' => $product])
        </a>
        <div class="caption">
            <h3 >
                <a href="{{ route('product.view', $product->slug)}}" class="product-title" title="{{ $product->title }}">
                    {{ $product->title }}
                </a>
            </h3>

            <p class="product-price">
                $ {{ number_format($product->price,2) }}
            </p>
            <p>
                <a class="btn btn-primary" href="{{ route('cart.add-to-cart', $product->id) }}">Add to Cart</a>
                @if(Auth::check() && Auth::user()->isInWishlist($product->id))
                <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->slug) }}">Remove from Wishlist</a>
                @else
                <a class="btn btn-warning" href="{{ route('wishlist.add', $product->slug) }}">Add to Wishlist</a>
                @endif
            </p>
        </div>
    </div>
</div>
<style>
    .product-title {
        font-size: 16px;
        height: 35px;
        overflow: hidden;
        display: block;
    }
</style>