<?php

$productAttributes = $model->getProductAllAttributes();

?>

<div class="row">

    <div class="col-12">

        <div id="add-attribute" class="input-group">

            <select name="product-attribute[]"
                    multiple="true"
                    class="select2 form-control modal-product-attribute-select"
                    style="width: 100%;height: 40px">
                @foreach($attributeOptions as $attributeId => $attributeName)
                    <option
                            @if($productAttributes->contains('attribute_id',$attributeId))
                            selected
                            @endif

                            value="{{ $attributeId }}">
                        {{ $attributeName }}
                    </option>
                @endforeach
            </select>


            <div class="input-group-append">
                <button type="button"
                        data-token="{{ csrf_token() }}"
                        class="btn btn-primary modal-use-selected">
                    Use Selected
                </button>
            </div>

        </div>


        <hr/>


        <div class="attribute-content-wrapper">

            @if(count($productAttributes) > 0 )


                @foreach($productAttributes as $productVarcharAttributeValue)


                    <?php $attribute = $productVarcharAttributeValue; ?>


                    @if($productVarcharAttributeValue->attribute->field_type == 'TEXT')
                        <div class="form-group">
                            <label for="attribute-{{ $productVarcharAttributeValue->attribute_id }}">
                                {{ $productVarcharAttributeValue->attribute->name }}
                            </label>

                            <input type="text"
                                   name="attribute[{{ str_random() }}][{{ $productVarcharAttributeValue->attribute_id  }}]"
                                   class="form-control"
                                   value="{{ $productVarcharAttributeValue->value }}"
                                   id="attribute-{{ $productVarcharAttributeValue->attribute_id }}"/>
                        </div>
                    @endif

                    @if($productVarcharAttributeValue->attribute->field_type == 'DATETIME')
                        <div class="form-group">
                            <label for="attribute-{{ $productVarcharAttributeValue->attribute_id }}">
                                {{ $productVarcharAttributeValue->attribute->name }}
                            </label>

                            <input type="text"
                                   name="attribute[{{ str_random() }}][{{ $productVarcharAttributeValue->attribute_id  }}]"
                                   class="form-control datetime"
                                   value="{{ $productVarcharAttributeValue->value }}"
                                   id="attribute-{{ $productVarcharAttributeValue->attribute_id }}"/>
                        </div>
                    @endif

                    @if($productVarcharAttributeValue->attribute->field_type == 'TEXTAREA')
                        <div class="form-group">
                            <label for="attribute-{{ $productVarcharAttributeValue->attribute_id }}">
                                {{ $productVarcharAttributeValue->attribute->name }}
                            </label>

                            <textarea
                                    name="attribute[{{ str_random() }}][{{ $productVarcharAttributeValue->attribute_id  }}]"
                                    class="form-control"
                                    id="attribute-{{ $productVarcharAttributeValue->attribute_id }}"
                            >{{ $productVarcharAttributeValue->value }}</textarea>

                        </div>
                    @endif

                    @if($productVarcharAttributeValue->attribute->field_type == 'SELECT')
                        <div class="form-group">
                            <label for="attribute-{{ $productVarcharAttributeValue->attribute_id }}">
                                {{ $productVarcharAttributeValue->attribute->name }}
                            </label>

                            <select name="attribute[{{ str_random() }}][{{ $productVarcharAttributeValue->attribute_id  }}]"
                                    class="form-control"
                                    id="attribute-{{ $productVarcharAttributeValue->attribute_id }}">

                                @foreach($productVarcharAttributeValue->attribute->attributeDropdownOptions as $option)
                                    <option
                                            value="{{ $option->id }}"

                                            @if($productVarcharAttributeValue->value == $option->id)
                                            selected
                                            @endif
                                    >
                                        {{ $option->display_text }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    @endif



                    @if($productVarcharAttributeValue->attribute->field_type == 'CHECKBOX')

                        <div class="form-check">

                            <input type="hidden"
                                   name="attribute[{{ str_random() }}][{{ $attribute->id  }}]"
                                   value="0"
                            />

                            <input type="checkbox"
                                   name="attribute[{{ str_random() }}][{{ $productVarcharAttributeValue->attribute_id  }}]"
                                   class="form-check-input"
                                   value="1"
                                   @if($productVarcharAttributeValue->value == 1)
                                   checked
                                   @endif
                                   id="attribute-{{ $productVarcharAttributeValue->attribute_id }}"
                            />


                            <label class="form-check-label"
                                   for="attribute-{{ $productVarcharAttributeValue->attribute_id }}">
                                {{ $productVarcharAttributeValue->attribute->name }}
                            </label>


                        </div>


                    @endif



                @endforeach
            @else
                <p>Sorry No Attribute Found assign Yet</p>
            @endif

        </div>
    </div>

</div>



@push('scripts')

    <script>


        $(function () {
            jQuery('.datetime').flatpickr({
                altInput: true,
                altFormat: "d-m-Y",
                dateFormat: "Y-m-d",
            });


            jQuery('.modal-use-selected').on('click', function (e) {

                var token = jQuery(this).attr('data-token');
                var element = jQuery(this).parents('#add-attribute:first').find('.modal-product-attribute-select');

                var data = {_token: token, attribute_id: element.val()};


                jQuery.ajax({
                    url: '{{ route('admin.attribute.element') }}',
                    data: data,
                    dataType: 'json',
                    method: 'post',
                    success: function (response) {
                        console.info(response);

                        if (response.success == true) {

                            //jQuery('#add-attribute').modal('hide');
                            jQuery('.attribute-content-wrapper').html(response.content);


                            jQuery('.datetime').flatpickr({
                                altInput: true,
                                altFormat: "d-m-Y",
                                dateFormat: "Y-m-d",
                            });


                        }
                    }
                });
            });


        });


    </script>



@endpush