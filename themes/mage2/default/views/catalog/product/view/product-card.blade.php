<div class="card">
    <div class="card-body">

        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->name }}">
            @include('catalog.product.view.product-image',['product' => $product])
        </a>

        <div class="caption">
            <h3>
                <a href="{{ route('product.view', $product->slug)}}" class="product-name"
                   title="{{ $product->name }}">
                    {{ $product->name }}
                </a>
            </h3>

            <p class="product-price">
                $ {{ number_format($product->price,2) }}

            </p>

            <div>
                {!! Form::open(['method' => 'post','action' => route('cart.add-to-cart')]) !!}
                <input type="hidden" name="slug" value="{{ $product->slug }}"/>

                <div class="product-stock">In Stock</div>
                <hr>

                <div class="clearfix"></div>
                <div class="float-left" style="margin-right: 5px;">
                    <button type="submit" class="btn btn-primary"
                            href="{{ route('cart.add-to-cart', $product->id) }}">
                        Add to Cart
                    </button>
                </div>
                {!! Form::close() !!}

                @if(Auth::check() && Auth::user()->isInWishlist($product->id))
                    <a class="btn btn-danger" title="Remove from Wish List"
                       data-toggle="tooltip" href="{{ route('wishlist.remove', $product->slug) }}"><i
                                class="oi oi-heart"></i></a>
                @else
                    <a class="btn btn-success" title="Add to Wish List" data-toggle="tooltip"
                       href="{{ route('wishlist.add', $product->slug) }}"><i class="oi oi-heart"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush