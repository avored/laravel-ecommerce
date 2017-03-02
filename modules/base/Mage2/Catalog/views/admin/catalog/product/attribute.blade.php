<div class="panel panel-default">
    <div class="panel-heading">
        <span>Attributes</span>
    </div>


    <div class="panel-body">
        <h4>Product Attribute Panel</h4>


        <div class="col-md-12">

            <label>Please Select Option</label>
                <span class="input-group">

                    <select class="attribute-select-field form-control" data-token="{{ csrf_token() }}">
                        @foreach($productAttributes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                 <a href="#" class="add-product-attribute input-group-addon">Add</a>
                </span>
        </div>

        <div class="clearfix"></div>
        <hr/>

        <div class="panel-group" id="attribute-accordion" role="tablist" aria-multiselectable="true">
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
                                //dd($variation->attributeDropdownOption->display_text);
                                ?>
                                <div class="col-md-12 single-option-box"
                                     style="border: 1px solid #ccc; padding: 10px;margin-bottom: 10px">

                                    <label>{{ $variation->title }}</label>

                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <div class="col-md-4 form-group">
                                            <label>Image</label>
                                            <input type="file"
                                                   name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][image]"
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Qty</label>
                                            <input type="text"
                                                   value="{{ $variation->qty }}"
                                                   name="attribute[{{ $variation->product_attribute_id }}][{{ $variation->attribute_dropdown_option_id}}][qty]"
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Price</label>
                                            <input type="text"
                                                   value="{{ $variation->price }}"
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
<script>

    jQuery(document).ready(function () {

        jQuery(document).on('click', '.add-product-attribute', function (e) {
            e.preventDefault();

            if (jQuery('.attribute-select-field').val() != "") {


                var data = {
                    id: jQuery('.attribute-select-field').val(),
                    _token: jQuery('.attribute-select-field').attr('data-token')
                }

                jQuery.ajax({
                    url: "{{ route('admin.product-attribute.get-attribute')  }}",
                    method: "post",
                    data: data,
                    success: function (response) {

                        jQuery('#attribute-accordion').append(response);


                    }
                })


            }
            else {
                alert('Please Select Attribute First');
            }


        });

    })
</script>