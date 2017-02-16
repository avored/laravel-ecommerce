{!! Form::select('product_attribute_group_id','Product Attribute Group' , $productAttributeGroupOptions) !!}


{!! Form::text('title','Title') !!}
{!! Form::text('identifier','Identifier') !!}

{!! Form::select('field_type','Field Type',['' => 'Please Select','TEXT' => 'Text','TEXTAREA' => 'Text Area','SELECT' => 'Dropdown'] ) !!}
{!! Form::select('type','Data Type',['' => 'Please Select','VARCHAR' => 'Varchar','FLOAT' => 'Float','TEXT' => 'Text Area'] ) !!}

@if(!isset($attribute->validation))
    <?php $validations = []; ?>
@else
    <?php $validations = explode("|", $attribute->validation); ?>
@endif

{!! Form::select('validation[]','Validation',['required' => 'Required','max:255' => 'Max Length 255'],['class' => 'select2 validate_field form-control','multiple' => true, 'value' => $validations] ) !!}

{!! Form::text('sort_order','Sort Order') !!}

<div class="dynamic-field hidden">
    <div class="dynamic-field-row">
        <div class="form-group col-md-6">
            <label>Label</label>
            <input disabled class="form-control" name="label[{{ strtolower(str_random('6')) }}]"/>
        </div>
        <div class="form-group col-md-6">
            <label>Value</label>

        <span class="input-group">
            <input disabled class="form-control" name="value[{{ strtolower(str_random('6')) }}]"/>
            <span class="input-group-addon  add-field" style='cursor: pointer'>Add</span>
        </span>
        </div>
    </div>


    <div class="dynamic-field-row-template hidden">
        <div class="form-group col-md-6">
            <label>Label</label>
            <input disabled class="form-control" name="label[__RANDOM_STRING__]"/>
        </div>
        <div class="form-group col-md-6">
            <label>Value</label>

        <span class="input-group">
            <input disabled class="form-control" name="value[__RANDOM_STRING__]"/>
            <span class="input-group-addon  add-field" style='cursor: pointer'>Add</span>
        </span>
        </div>
    </div>
</div>

<script>


    jQuery(document).ready(function () {

        jQuery('.add-field').on('click', function (e) {
            e.stopPropagation();
            var rowTemplate = jQuery('.dynamic-field-row-template').html();


            var randomString = "";
            var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 5; i++) {
                randomString += possible.charAt(Math.floor(Math.random() * possible.length));
            }

            rowTemplate = rowTemplate.replace(/__RANDOM_STRING__/g, randomString);

            jQuery(e.target).html('Remove');

            jQuery('.dynamic-field-row').append(rowTemplate);
            jQuery('.dynamic-field-row').append(rowTemplate);

            console.info(rowTemplate);

        })
        jQuery('#field_type').on('change', function (e) {
            //e.stopPropogation();

            if (jQuery(e.target).val() == "TEXT") {
                jQuery('.validate_field').val('max:255');
                jQuery('.validate_field').trigger('change.select2');
            }

            if (jQuery(e.target).val() == "SELECT") {
                if (jQuery('.dynamic-field').hasClass('hidden')) {

                    jQuery('.dynamic-field').removeClass('hidden');
                    jQuery('.dynamic-field input').attr('disabled', false);

                } else {
                    jQuery('.dynamic-field').addClass('hidden');
                    jQuery('.dynamic-field input').attr('disabled', true);
                }


            }

        })


    });

</script>