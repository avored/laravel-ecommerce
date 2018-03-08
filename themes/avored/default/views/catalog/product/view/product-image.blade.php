<?php

$image = $product->image;
$imageType = (isset($imageType)) ? $imageType : "smallUrl"
?>
@if(NULL !== $image)
    <img alt="{{ $product->title }}"
         style="max-height: 300px;"
         class="card-img-top img-responsive"
         src="{{ $image->$imageType }}"/>
@endif