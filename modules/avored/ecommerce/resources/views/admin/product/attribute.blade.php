<div class="card card-default main-attribute-card">

    <div class="card-header">
        <span>Attributes</span>
    </div>

    <div class="card-body">


        <?php
        $attributes = [];

        if (isset($product)) {
            $attributes = $product->getAssignedAttributes();
        }

        //todo How does multiple Variation works
        //$firstVariation = $product->productVariations()->get()->first();
        //$attribute = $firstVariation->productAttribute;

        ?>
        @foreach($attributes as $attribute)
            <div class="card card-default ">
                <button type="button" class="remove-attribute close" data-dismiss="alert" aria-label="Close">
                    &times;
                </button>
                <div class="card-header">
                    Product Attribute card
                </div>
                <div class="card-body">
                    @if(isset($product) && $product->has_variation == 1)
                        <div class="col-md-12">
                            <label>Please Select Option</label>
                            <span class="input-group">

                                <select class="attribute-select-field form-control"
                                        data-token="{{ csrf_token() }}">
                                    @foreach($productAttributes as $value => $label)
                                        <option
                                            <?php echo ($value == $attribute->product_attribute_id) ? "selected" : "" ?>
                                            value="{{ $value }}">
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                <a href="#" class="add-product-attribute input-group-addon">Use This</a>
                            </span>
                        </div>

                        <div class="clearfix"></div>
                        <hr/>

                        <div class="card-group attribute-accordion" id="" role="tablist" aria-multiselectable="true">

                            <div class="card card-default">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h4 class="card-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseOne-{{ $attribute->id }}"
                                           aria-expanded="true"
                                           aria-controls="collapseOne">
                                            Available Variations
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne-{{ $attribute->id }}" class="card-collapse collapse in"
                                     role="tabcard"
                                     aria-labelledby="headingOne">
                                    <div class="card-body">


                                        @foreach($product->getAssignedVariationBytAttributeId($attribute->product_attribute_id) as $variation)
                                            <?php
                                            $subProduct = $variation->subProduct;
                                            ?>
                                            <div class="col-md-12 single-option-box"
                                                 style="border: 1px solid #ccc; padding: 10px;margin-bottom: 10px">
                                                <button type="button" class="remove-variation-attribute close"
                                                        data-dismiss="alert" aria-label="Close">
                                                    &times;
                                                </button>

                                                <label>{{ $subProduct ->title }}</label>

                                                <div class="clearfix"></div>
                                                <div class="col-md-12">

                                                    <div class="col-md-3 form-group">
                                                        <label>Image</label>
                                                        <input type="file"
                                                               name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][image]"
                                                               class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label>SKU</label>
                                                        <input type="text"
                                                               value="{{ $subProduct->sku }}"
                                                               name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][sku]"
                                                               class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Qty</label>
                                                        <input type="text"
                                                               value="{{ $subProduct->qty }}"
                                                               name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][qty]"
                                                               class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Price</label>
                                                        <input type="text"
                                                               value="{{ $subProduct->price }}"
                                                               name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][price]"
                                                               class="form-control"/>
                                                        <input type="hidden"
                                                               name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][id]"
                                                               value="{{ $variation->id }}">
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="cold-md-12">

                                                        <div class="col-md-3">
                                                            <?php
                                                            //dd($subProduct->image);
                                                            ?>
                                                            <img src="{{ $subProduct->image->smallUrl }}"
                                                                 class="img-responsive img-thumbnail"
                                                                 style="max-height: 75px;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>


                </div>
            </div>
            @endif

        @endforeach


        <div class="col-md-12">
            <a class="add-another-card-button" href="#">Add Another</a>
        </div>
    </div>
</div>

<div class="hidden product-attribute-main-card-template">
    <div class="card card-default ">
        <button type="button" class="remove-attribute close" data-dismiss="alert" aria-label="Close">
            &times;
        </button>
        <div class="card-header">
            Product Attribute card
        </div>
        <div class="card-body">
            <div class="col-md-12">

                <label>Please Select Option</label>
                <span class="input-group">
                    <select class="attribute-select-field form-control" data-token="{{ csrf_token() }}">
                        @foreach($productAttributes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                 <a href="#" class="add-product-attribute input-group-addon">Use This</a>
                </span>
            </div>

            <div class="clearfix"></div>
            <hr/>

            <div class="card-group attribute-accordion" id="" role="tablist" aria-multiselectable="true">
            </div>

        </div>
    </div>
</div>
<script>

    jQuery(document).ready(function () {

        jQuery(document).on('click', '.add-another-card-button', function (e) {

            e.preventDefault();
            var html = jQuery('.product-attribute-main-card-template').html();
            jQuery(e.target).parent().before(html);
        });

        jQuery(document).on('click', '.remove-attribute', function (e) {
            jQuery(e.target).parent().remove();
        });

        jQuery(document).on('click', '.remove-variation-attribute', function (e) {
            jQuery(e.target).parent().remove();
        });

        jQuery(document).on('click', '.add-product-attribute', function (e) {
            e.preventDefault();

            var el = jQuery(e.target);

            if (jQuery(e.target).parent().find('.attribute-select-field:first').val() != "") {
                var data = {
                    id: jQuery(e.target).parent().find('.attribute-select-field:first').val(),
                    _token: jQuery(e.target).parent().find('.attribute-select-field:first').attr('data-token')
                }

                jQuery.ajax({
                    url: "{{ route('admin.product-attribute.get-attribute')  }}",
                    method: "post",
                    data: data,
                    success: function (response) {
                        jQuery(el).parents('.card-body:first').find('.attribute-accordion').append(response);
                        //jQuery('#attribute-accordion').append(response.attributeHtml);
                        //jQuery('.main-attribute-card .card-body').append(response.attributeHtml);
                    }
                })
            }
            else {
                alert('Please Select Attribute First');
            }
        });

        jQuery(document).ready(function () {

            jQuery(document).on('click', '.close-variation', function (e) {
                e.preventDefault();
                jQuery(this).parents('.single-option-box:first').remove();
            });
        });

    });
</script>
<style>
    .remove-attribute, .remove-variation-attribute {
        font-size: 42px;
        margin-right: 10px;
    }
</style>