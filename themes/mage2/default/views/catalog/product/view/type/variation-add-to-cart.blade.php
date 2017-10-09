<form method="post" action="{{ route('cart.add-tocart') }}">
    {{ csrf_field() }}

<input type="hidden" name="slug" value="{{ $product->slug }}"/>
<input id="product-price-hidden" type="hidden" name="price" value="{{ $product->price }}"/>
<div class="product-stock">In Stock</div>
<hr>
<div class="row">
    <div class="form-group col-md-1" style="">
        <label>Qty</label>
        <input type="text" name="qty" class="form-control" value="1"/>
    </div>
</div>

<?php
$attributes = $product->getAssignedAttributes();
?>
@foreach($product->getAssignedAttributes() as $productVariation)
    <?php
    $attribute = $productVariation->productAttribute;
    ?>
    <div class="product-attribute form-group">
        <label>{{$attribute->title}}</label>
        <select name="attribute[{{ $attribute->id }}]" class="form-control product-variation-dropdown">

            <option data-qty="0" data-price="{{ number_format('0.00',2) }}" value="">Please Select</option>

            @foreach ($attribute->productVariations  as $option)

                <?php $subProduct = $option->subProduct; ?>

                <option data-qty="{{ $subProduct->qty }}" data-price="{{ number_format(($subProduct->price),2) }}"
                        value="{{ $subProduct->id }}">{{ $subProduct->title }}</option>

            @endforeach
        </select>

    </div>
@endforeach

<div class="clearfix"></div>
<div class="float-left" style="margin-right: 5px;">
    <button disabled type="submit" class="btn add-to-cart btn-primary"
            href="{{ route('cart.add-to-cart', $product->id) }}">
        Add to Cart
    </button>
</div>
</form>

<script>

    jQuery(document).ready(function () {
        jQuery('.product-variation-dropdown').change(function (e) {
            e.preventDefault();

            var basePrice = parseFloat(jQuery('#product-price-hidden').val());
            var i = 0;
            var attributePrice = 0;

            jQuery('.product-attribute .product-variation-dropdown').each(function (index, el) {
                if (typeof(jQuery(el).val()) != "undefined" && jQuery(el).val() != "") {
                    i++;
                    var attributeValue = jQuery(el).val();

                    jQuery(el).find('option').each(function (index, element) {

                        if (jQuery(element).attr('value') == attributeValue) {
                            attributePrice += parseFloat(jQuery(element).attr('data-price'));
                        }
                    });
                }
            });

            var totalPrice = attributePrice + basePrice;
            jQuery('.price').text(totalPrice.toFixed(2));

            if (jQuery('.product-variation-dropdown').length == i) {
                jQuery('.add-to-cart').attr('disabled', false);
            } else {
                jQuery('.add-to-cart').attr('disabled', true);
            }
        });
    });
</script>