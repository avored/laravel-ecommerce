<div class="row">

    <div class="col-12">

        <a href="#"
           class="float-right btn btn-warning"
           data-toggle="modal" data-target="#add-property">
            <i class="fa fa-plus" aria-hidden="true"></i> Add Property
        </a>

        <div class="clearfix"></div>
        <hr/>



        <div class="property-content-wrapper">

        @if(count($productProperties = $model->productProperties) > 0 )


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



<div class="modal" tabindex="-1" id="add-property" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Please Select Property to Use</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                    @include('mage2-ecommerce::forms.select2',['name' => 'product-property[]',
                                                                'label' => 'Property' ,
                                                                'options' => $properties,
                                                                'values' => [],
                                                                'attributes' => ['multiple' => true,
                                                                                'class' => 'select2 form-control modal-product-property-select',
                                                                                'style' => 'width:100%']
                                                                ])




            </div>
            <div class="modal-footer">
                <button type="button"
                        data-token="{{ csrf_token() }}"
                        class="btn btn-primary modal-use-selected">
                    Use Selected
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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

                        jQuery('#add-property').modal('hide');
                        jQuery('.property-content-wrapper').html(response.content);

                    }
                }
            });
        });


    });


    </script>



@endpush