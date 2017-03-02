
<?php
$image = $product->images()->get()->first();

?>
@if(NULL !== $image)
    <img alt="{{ $product->title }}"
         class="img-responsive"
         src="{{ asset('/uploads/catalog/images/'. $image->path)  }}"/>
@else
    <img alt="{{ $product->title }}"
         class="img-responsive"
         src="{{ asset('/img/default-product.jpg') }}"/>
@endif