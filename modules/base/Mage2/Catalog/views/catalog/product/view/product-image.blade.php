@if(isset($product->getProductImages($first = true)->value))
    <img alt="{{ $product->title }}"
         class="img-responsive"
         src="{{ asset('/uploads/catalog/images/'. $product->getProductImages($first= true)->value)  }}"/>
@else
    <img alt="{{ $product->title }}"
         class="img-responsive"
         src="{{ asset('/img/default-product.jpg') }}"/>
@endif