<form method="post" action="{{ route('cart.add-to-cart') }}">
    {{ csrf_field() }}

<input type="hidden" name="slug" value="{{ $product->slug }}"/>
<input id="product-price-hidden" type="hidden" name="price" value="{{ $product->price }}"/>
<div class="badge badge-success fill">In Stock</div>
<hr>
<div class="row">
    <div class="form-group col-md-1" style="">
        <label>Qty</label>
        <input type="text" name="qty" class="form-control" value="1"/>
    </div>
</div>

@php
    $attributes = $product->attribute;
@endphp
    <div class="product-attributes-wrapper">
        @foreach($attributes as $attribute)
            <div class="product-attribute form-group">
                <label>{{$attribute->name}}</label>
                <select name="attribute[{{ $attribute->id }}]"
                    data-attribute-id="{{ $attribute->id }}"
                    class="form-control product-variation-dropdown"
                >
                    <option value="">Please Select</option>
                    @foreach($attribute->attributeDropdownOptions as $option)
                        <option value="{{ $option->id }}">
                            {{ $option->display_text }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="attribute[variation_id]" value="2" id="selected_variation_id">
        @endforeach
    </div>

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
        jQuery('.product-attributes-wrapper').data('AttributeJsonData', {!! json_encode($jsonData) !!});
        jQuery('.product-variation-dropdown').change(function (e) {
            e.preventDefault();

            var basePrice = parseFloat(0);
            var i = 0;
            attributePrice = 0;
            var variationId;
            var attributesJsonData = jQuery('.product-attributes-wrapper').data().AttributeJsonData;

            jQuery('.product-attribute .product-variation-dropdown').each(function (index, el) {
                if (typeof(jQuery(el).val()) != "undefined" && jQuery(el).val() != "") {
                    i++;
                    attributeId = jQuery(el).attr('data-attribute-id');
                    var attributeValue = jQuery(el).val();
                    
                    Object.keys(attributesJsonData).forEach(function(key){
                        if (!_.has(attributesJsonData, [key, attributeId, attributeValue])) {
                            attributesJsonData = _.omit(attributesJsonData, [key, attributeId, attributeValue])
                        }
                    });
                }
            });

            if (i === jQuery('.product-attributes-wrapper .product-attribute').length) {
                Object.keys(attributesJsonData).forEach(function(key){
                    Object.keys(attributesJsonData[key]).forEach(function(attributeId) {
                        Object.keys(attributesJsonData[key][attributeId]).forEach(function(attributeValue) {
                            var variationInfo = attributesJsonData[key][attributeId][attributeValue];
                            attributePrice = variationInfo.price;
                            variationId = key;
                        });
                    })
                });
            } else {
                attributePrice = 0;
            }


            if (jQuery('.product-variation-dropdown').length == i) {
                var totalPrice = attributePrice + basePrice;
                jQuery('#selected_variation_id').val(variationId);
                jQuery('.price').text(totalPrice.toFixed(2));
                jQuery('.add-to-cart').attr('disabled', false);
            } else {
                jQuery('.add-to-cart').attr('disabled', true);
            }
        });
    });
</script>
