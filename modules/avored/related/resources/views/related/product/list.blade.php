<div class="row">
    <div class="col-md-12">
        <h5 class="h3">
            {{ __('avored-related::related.related-product') }}
        </h5>

        @php
            $relatedProducts = $related->getRelatedProducts($product->id);
        @endphp
        
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-4">
                    @include('product.view.product-card', ['product' => $relatedProduct,'extraImage' => false])
                </div>
            @endforeach
        </div>
    </div>
</div>