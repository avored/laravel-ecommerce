<?php

$productProperties = $model->getProductAllProperties();
?>

<div class="row">

    <div class="col-12">

        <div id="add-property" class="input-group">

            <select name="product-property[]"
                    multiple="true"
                    class="select2 form-control modal-product-property-select"
                    style="width: 100%;height: 40px">
                @foreach($propertyOptions as $propertyId => $propertyName)
                    <option
                            @if($productProperties->contains('id',$propertyId))
                                    selected
                            @endif

                            value="{{ $propertyId }}">
                        {{ $propertyName }}
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



        <div class="property-content-wrapper">

        @if(count($productProperties) > 0 )


            @foreach($productProperties as $productVarcharPropertyValue)


                <?php $property = $productVarcharPropertyValue; ?>


                @if($productVarcharPropertyValue->property->field_type == 'TEXT')
                    <div class="form-group">
                        <label for="property-{{ $productVarcharPropertyValue->property_id }}">
                            {{ $productVarcharPropertyValue->property->name }}
                        </label>

                        <input type="text"
                               name="property[{{ str_random() }}][{{ $productVarcharPropertyValue->property_id  }}]"
                               class="form-control"
                               value="{{ $productVarcharPropertyValue->value }}"
                               id="property-{{ $productVarcharPropertyValue->property_id }}" />
                    </div>
                @endif

                @if($productVarcharPropertyValue->property->field_type == 'CHECKBOX')

                    <div class="form-check">

                        <input type="hidden"
                               name="property[{{ str_random() }}][{{ $property->id  }}]"
                               value="0"
                        />

                        <input type="checkbox"
                               name="property[{{ str_random() }}][{{ $productVarcharPropertyValue->property_id  }}]"
                               class="form-check-input"
                               value="1"
                               value="{{ $productVarcharPropertyValue->value }}"
                               id="property-{{ $productVarcharPropertyValue->property_id }}"
                        />


                        <label class="form-check-label"
                               for="property-{{ $productVarcharPropertyValue->property_id }}">
                            {{ $productVarcharPropertyValue->property->name }}
                        </label>


                    </div>


                @endif


                @if($property->field_type == 'TEXTAREA')

                        <div class="form-group">
                            <label for="property-{{ $property->id }}">{{ $property->name }}</label>
                            <textarea
                                    name="property[{{ $property->id  }}]"
                                    class="form-control"
                                    id=property-{{ $property->id }}"
                                    >{{ $model->getSpecificationValue($property) }}</textarea>

                        </div>


                    @endif

                @if($property->field_type == 'SELECT')


                        <div class="form-group">
                            <label for="property-{{ $property->id }}">{{ $property->name }}</label>

                            <select name="property[{{ $property->id  }}]"
                                    class="form-control"
                                    id=property-{{ $property->id }}">


                                <option value="">Please Select</option>
                                @foreach($property->attributeDropdownOptions()->get() as $dropdown)

                                <option
                                        @if($model->getSpecificationValue($property) == $dropdown->id)
                                                selected
                                        @endif
                                        value="{{ $dropdown->id }}">{{ $dropdown->display_text }}</option>
                                @endforeach
                            </select>

                        </div>
                @endif

            @endforeach
        @else
            <p>Sorry No Property Found assign Yet</p>
        @endif

        </div>
    </div>

</div>



@push('scripts')

    <script>

    jQuery(document).ready(function(){

        jQuery('.modal-use-selected').on('click',function (e) {

            var token = jQuery(this).attr('data-token');
            var element = jQuery(this).parents('#add-property:first').find('.modal-product-property-select');

            var data = {_token: token, property_id: element.val()};


            jQuery.ajax({
                url: '{{ route('admin.property.element') }}',
                data: data,
                dataType: 'json',
                method: 'post',
                success:function (response) {
                    console.info(response);

                    if(response.success == true) {

                        //jQuery('#add-property').modal('hide');
                        jQuery('.property-content-wrapper').html(response.content);

                    }
                }
            });
        });


    });


    </script>



@endpush