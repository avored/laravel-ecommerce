<div class="panel panel-default main-attribute-panel">

    <div class="panel-heading">
        <span>Attributes</span>
    </div>

    <div class="panel-body">
        <div class="panel panel-default ">
            <button type="button" class="remove-attribute close" data-dismiss="alert" aria-label="Close">
                &times;
            </button>
            <div class="panel-heading">
                Product Attribute Panel
            </div>
            <div class="panel-body">
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

                <div class="panel-group attribute-accordion" id="" role="tablist" aria-multiselectable="true">
                    @if(isset($product) && $product->has_variation == 1)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="true"
                                       aria-controls="collapseOne">
                                        Available Variations
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">

                                    @foreach($product->productVariations()->get() as $variation)
                                        <?php
                                        $subProduct = $variation->subProduct;
                                        ?>
                                        <div class="col-md-12 single-option-box"
                                             style="border: 1px solid #ccc; padding: 10px;margin-bottom: 10px">

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
                                                    <input type="hidden" name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][id]" value="{{ $variation->id }}">
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>


        <div class="col-md-12">
        <a class="add-another-panel-button" href="#">Add Another</a>
        </div>
    </div>
</div>

<div class="hidden product-attribute-main-panel-template">
<div class="panel panel-default ">
    <button type="button" class="remove-attribute close" data-dismiss="alert" aria-label="Close">
        &times;
    </button>
    <div class="panel-heading">
        Product Attribute Panel
    </div>
    <div class="panel-body">
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

        <div class="panel-group attribute-accordion" id="" role="tablist" aria-multiselectable="true">
        </div>

    </div>
</div>
</div>
<script>

    jQuery(document).ready(function () {


        jQuery(document).on('click', '.add-another-panel-button', function (e) {

            e.preventDefault();

            var html = jQuery('.product-attribute-main-panel-template').html();

            jQuery(e.target).parent().before(html);

            //jQuery('.select2').select2();

            //if(jQuery('.remove-attribute').length > 1) {
            //    jQuery(e.target).parent();
            //} else {
            //    alert('Sorry not allowed');
            //}
        });

        jQuery(document).on('click', '.remove-attribute', function (e) {

            console.info(jQuery('.remove-attribute').length);

            if(jQuery('.remove-attribute').length > 2) {
                jQuery(e.target).parent().remove();
            } else {
                alert('Sorry not allowed');
            }
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
                        jQuery(el).parents('.panel-body:first').find('.attribute-accordion').append(response);
                        //jQuery('#attribute-accordion').append(response.attributeHtml);
                        //jQuery('.main-attribute-panel .panel-body').append(response.attributeHtml);
                    }
                })
            }
            else {
                alert('Please Select Attribute First');
            }
        });

    })
</script>
<style>
    .remove-attribute {
        font-size:42px;
        margin-right: 10px;
    }
</style>