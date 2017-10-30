<div class="row">

    <div class="col-12">


        @if(count($specificationAttributes = $model->getSpecificationList()) > 0 )


            @foreach($specificationAttributes as $attribute)

                @if($attribute->field_type == 'TEXT')
<?php

                    $model->getSpecificationValue($attribute) ;

    ?>

                    <div class="form-group">
                        <label for="attribute-specification-{{ $attribute->id }}">{{ $attribute->name }}</label>
                        <input type="text"
                               name="attributes_specification[{{ $attribute->id  }}]"
                               class="form-control"
                               value="{{ $model->getSpecificationValue($attribute) }}"
                               id=attribute-specification-{{ $attribute->id }}" />
                    </div>


                @endif

                @if($attribute->field_type == 'SELECT')
                    <p>SELECT ATTRIBUTE HERE</p>
                @endif


            @endforeach
        @else

            <p>Sorry No Attrbite Found in these group</p>

        @endif
    </div>

</div>

