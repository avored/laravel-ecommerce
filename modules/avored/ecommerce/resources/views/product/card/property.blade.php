<?php
$productProperties = $model->getPropertiesAll();
?>

<div class="row">

    <div class="col-12">

        <div id="add-property" class="input-group">

            <select name="product-property[]"
                    multiple="true"
                    class="select2 form-control modal-product-property-select"
                    style="width: 88%">
                @foreach($propertyOptions as $propertyId => $propertyName)
                    <option
                            @if($productProperties->contains('property_id',$propertyId))
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
                        class="btn btn-warning modal-use-selected">
                    Use Selected
                </button>
            </div>

        </div>
        <hr/>
        <div class="property-content-wrapper">


            @if($productProperties->count() > 0 )

                @foreach($productProperties as $productVarcharPropertyValue)

                    @php
                    if(!$productVarcharPropertyValue instanceof \AvoRed\Framework\Models\Database\Property) {
                        $property = $productVarcharPropertyValue->property;
                        //dd($productVarcharPropertyValue);
                    } else {
                        $property = $productVarcharPropertyValue;
                    }

                    @endphp

                    @if($property->field_type == 'TEXT')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <input type="text"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   class="form-control"
                                   value="{{ $productVarcharPropertyValue->value }}"
                                   id="property-{{ $property->id }}"/>
                        </div>
                    @endif

                    @if($property->field_type == 'DATETIME')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <input type="text"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   class="form-control datetime"
                                   value="{{ $productVarcharPropertyValue->value }}"
                                   id="property-{{ $property_id }}"/>
                        </div>
                    @endif

                    @if($property->field_type == 'TEXTAREA')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <textarea
                                    name="property[{{ str_random() }}][{{ $property->id  }}]"
                                    class="form-control"
                                    id="property-{{ $property->id }}"
                            >{{ $productVarcharPropertyValue->value }}</textarea>

                        </div>
                    @endif

                    @if($property->field_type == 'SELECT')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <select name="property[{{ str_random() }}][{{ $property->id  }}]"
                                    class="form-control"
                                    id="property-{{ $property->id }}">

                                @foreach($property->propertyDropdownOptions as $option)
                                    <option
                                            value="{{ $option->id }}"

                                            @if($productVarcharPropertyValue->value == $option->id)
                                            selected
                                            @endif
                                    >
                                        {{ $option->display_text }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    @endif

                    @if($property->field_type == 'CHECKBOX')

                        <div class="form-check">

                            <input type="hidden"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   value="0"
                            />

                            <input type="checkbox"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   class="form-check-input"
                                   value="1"
                                   @if($productVarcharPropertyValue->value == 1)
                                   checked
                                   @endif
                                   id="property-{{ $property->id }}"
                            />


                            <label class="form-check-label"
                                   for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>


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

        $(function () {
            jQuery('.modal-use-selected').on('click', function (e) {

                var token = jQuery(this).attr('data-token');
                var element = jQuery(this).parents('#add-property:first').find('.modal-product-property-select');

                var data = {_token: token, property_id: element.val()};


                jQuery.ajax({
                    url: '{{ route('admin.property.element') }}',
                    data: data,
                    dataType: 'json',
                    method: 'post',
                    success: function (response) {

                        if (response.success == true) {

                            //jQuery('#add-property').modal('hide');
                            jQuery('.property-content-wrapper').html(response.content);

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