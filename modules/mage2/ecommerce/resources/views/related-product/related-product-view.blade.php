<div role="tabcard" class="tab-pane" id="related-product">
    <div class="related-product-grid mt-4 row">

        @foreach($relatedProducts as $product)
            <div class="col-3">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->name }}">
                            @include('catalog.product.view.product-image',['product' => $product])
                        </a>

                        <div class="caption">
                            <h3>
                                <a href="{{ route('product.view', $product->slug)}}" class="product-title"
                                   title="{{ $product->name }}">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="product-price">
                                $ {{ number_format($product->price,2) }}
                            </p>
                            <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->name }}" class="btn btn-primary">
                                View
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>