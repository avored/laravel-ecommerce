<div class="row">

    <div class="col-12">


        @if(count($specificationAttributes = $model->getSpecificationList()) > 0 )


            @foreach($specificationAttributes as $attribute)

                @if($attribute->field_type == 'TEXT')

                    <div class="form-group">
                        <label for="attribute-specification-{{ $attribute->id }}">{{ $attribute->name }}</label>
                        <input type="text"
                               name="attributes_specification[{{ $attribute->id  }}]"
                               class="form-control"
                               value="{{ $model->getSpecificationValue($attribute) }}"
                               id=attribute-specification-{{ $attribute->id }}" />
                    </div>


                @endif


                @if($attribute->field_type == 'TEXTAREA')

                        <div class="form-group">
                            <label for="attribute-specification-{{ $attribute->id }}">{{ $attribute->name }}</label>
                            <textarea
                                    name="attributes_specification[{{ $attribute->id  }}]"
                                    class="form-control"
                                    id=attribute-specification-{{ $attribute->id }}"
                                    >{{ $model->getSpecificationValue($attribute) }}</textarea>
                            
                        </div>


                    @endif

                @if($attribute->field_type == 'SELECT')

                        <div class="form-group">
                            <label for="attribute-specification-{{ $attribute->id }}">{{ $attribute->name }}</label>

                            <select name="attributes_specification[{{ $attribute->id  }}]"
                                    class="form-control"
                                    id=attribute-specification-{{ $attribute->id }}">


                                <option value="">Please Select</option>
                                @foreach($attribute->attributeDropdownOptions as $dropdown)

                                <option
                                        @if($model->getSpecificationValue($attribute) == $dropdown->id)
                                                selected
                                        @endif
                                        value="{{ $dropdown->id }}">{{ $dropdown->display_text }}</option>
                                @endforeach
                            </select>

                        </div>
                @endif


            @endforeach
        @else

            <p>Sorry No Attrbite Found in these group</p>

        @endif
    </div>

</div>

