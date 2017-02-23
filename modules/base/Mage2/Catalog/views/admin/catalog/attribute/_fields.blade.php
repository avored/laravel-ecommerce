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


<?php

$pool = 'abcdefghijklmnopqrstuvwxyz';

$randomString = substr(str_shuffle(str_repeat($pool, 6)), 0, 6);

$hiddenClass = "hidden";
$editMode = false;
if (isset($attribute) && $attribute->attributeDropdownOptions->count() > 0) {
    $editMode = true;
    $hiddenClass = "";
}
?>

<div class="dynamic-field {{ $hiddenClass }}">

    @if($editMode === true)

        @foreach($attribute->attributeDropdownOptions as $key => $dropdownOptionModel)

            <div class="dynamic-field-row">

                <div class="form-group col-md-6">
                    <label>Label</label>
                    <input class="form-control" name="dropdown-options[{{ $dropdownOptionModel->id }}][label]"
                           value="{{ $dropdownOptionModel->label }}"/>
                </div>
                <div class="form-group col-md-6">
                    <label>Value</label>

        <span class="input-group">
            <input class="form-control" name="dropdown-options[{{ $dropdownOptionModel->id }}][value]"
                   value="{{ $dropdownOptionModel->value }}"/>

            @if ($loop->last)
                <span class="input-group-addon  add-field" style='cursor: pointer'>Add</span>
            @else
                <span class="input-group-addon  remove-field" style='cursor: pointer'>Remove</span>

            @endif


        </span>
                </div>
            </div>

        @endforeach

    @else

        <div class="dynamic-field-row">
            <div class="form-group col-md-6">
                <label>Label</label>
                <input disabled class="form-control" name="dropdown-options[{{ $randomString }}][label]"/>
            </div>
            <div class="form-group col-md-6">
                <label>Value</label>

        <span class="input-group">
            <input disabled class="form-control" name="dropdown-options[{{ $randomString }}][value]"/>
            <span class="input-group-addon  add-field" style='cursor: pointer'>Add</span>
        </span>
            </div>
        </div>

    @endif

    <div class="dynamic-field-row-template hidden">
        <div class="dynamic-field-row">
            <div class="form-group col-md-6">
                <label>Label</label>
                <input  class="form-control" name="dropdown-options[__RANDOM_STRING__][label]"/>
            </div>
            <div class="form-group col-md-6">
                <label>Value</label>

        <span class="input-group">
            <input  class="form-control" name="dropdown-options[__RANDOM_STRING__][value]"/>
            <span class="input-group-addon  add-field" style='cursor: pointer'>Add</span>
        </span>
            </div>
        </div>
    </div>
</div>

<script>


    jQuery(document).ready(function () {

        jQuery(document).on('click', '.add-field', function (e) {

            e.preventDefault();

            var rowTemplate = jQuery('.dynamic-field-row-template').html();
            var randomString = "";
            var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 5; i++) {
                randomString += possible.charAt(Math.floor(Math.random() * possible.length));
            }

            rowTemplate = rowTemplate.replace("__RANDOM_STRING__", randomString);
            rowTemplate = rowTemplate.replace("__RANDOM_STRING__", randomString);

            jQuery(e.target).html('Remove');

            jQuery(e.target).removeClass('add-field');
            jQuery(e.target).addClass('remove-field');

            jQuery(e.target).parents('.dynamic-field-row:first').after(rowTemplate);
            //jQuery('.dynamic-field-row').after(rowTemplate);
            //jQuery('.dynamic-field-row').append(rowTemplate);

            console.info(rowTemplate);

        });
        jQuery(document).on('click', '.remove-field', function (e) {

            e.preventDefault();
            jQuery(e.target).parents('.dynamic-field-row:first').remove();

        })
        jQuery('#field_type').on('change', function (e) {
            //e.stopPropogation();

            jQuery('.dynamic-field input').attr('disabled', true);
            jQuery('.dynamic-field').addClass('hidden');
            jQuery('.validate_field').val('');
            jQuery('.validate_field').trigger('change.select2');


            if (jQuery(e.target).val() == "TEXT") {
                jQuery('.validate_field').val('max:255');
                jQuery('.validate_field').trigger('change.select2');
            }

            if (jQuery(e.target).val() == "SELECT" && jQuery('.dynamic-field').hasClass('hidden')) {
                jQuery('.dynamic-field').removeClass('hidden');
                jQuery('.dynamic-field input').attr('disabled', false);

            }

        })


    });

</script>