{!! Form::open(['method' => 'get','action' => route('cart.add-to-cart', $product->id)]) !!}
<div class="product-stock">In Stock</div>
<hr>
<div class="row">
    <div class="form-group col-md-1" style="">
        <label>Qty</label>
        <input type="text" name="qty" class="form-control" value="1"/>
    </div>
</div>

<?php
$variation = $product->productVariations->first();
$attribute = $variation->productAttribute;
        //dd($attribute);
//dd($variation->attributeDropdownOptions);

?>
<div class="form-group">
    <label>{{$attribute->title}}</label>
    <select name="attribute[{{ $attribute->id }}]" class="form-control product-variation-dropdown">

        <option data-qty="0" data-price="{{ number_format($product->price,2) }}" value="">Please Select</option>
        @foreach ($product->productVariations  as $option)

            <?php $val = $option->attributeDropdownOption ?>

            <option data-qty="{{ $option->qty }}" data-price="{{ number_format(($product->price + $option->price),2) }}"
                    value="{{ $option->id }}">{{ $val->display_text }}</option>


        @endforeach
    </select>
</div>

<div class="clearfix"></div>
<div class="pull-left" style="margin-right: 5px;">
    <button disabled type="submit" class="btn add-to-cart btn-primary"
            href="{{ route('cart.add-to-cart', $product->id) }}">
        Add to Cart
    </button>
</div>
{!! Form::close() !!}

<script>

    jQuery(document).ready(function () {
        jQuery('.product-variation-dropdown').change(function (e) {
            e.preventDefault();

            val = jQuery(e.target).val();
            jQuery(e.target).find('option').each(function (index, el) {
                if (jQuery(el).attr('value') == val) {

                    jQuery('.product-price .price').text(jQuery(el).attr('data-price'));

                    if(jQuery(el).attr('data-qty') <= 0) {
                        jQuery('.add-to-cart').attr('disabled', true);
                    } else {
                        jQuery('.add-to-cart').attr('disabled', false);
                    }
                }
            });

        });
    });
</script>