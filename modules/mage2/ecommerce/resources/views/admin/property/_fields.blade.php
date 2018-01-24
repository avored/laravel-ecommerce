


@include('mage2-ecommerce::forms.text',['name' => 'name','label' => 'Name'])
@include('mage2-ecommerce::forms.text',['name' => 'identifier','label' => 'Identifier'])

@include('mage2-ecommerce::forms.select',['name' => 'data_type',
                                            'label' => 'Data Type',
                                            'options' => [
                                                        'VARCHAR' => 'Varchar (Max 255)',
                                                        'DECIMAL' => 'Decimal',
                                                        'TEXT' => 'Text (Big Text e.g Description)',
                                                        'INTEGER' => 'Integer',
                                                        'DATETIME' => 'Date Time',
                                                        'BOOLEAN' => 'Boolean'
                                                        ]
                                        ])



@include('mage2-ecommerce::forms.select',['name' => 'field_type',
                                            'label' => 'Field Type',
                                            'options' => [
                                                        'TEXT' => 'Text Field',
                                                        'CHECKBOX' => 'Check box',
                                                        'TEXTAREA' => 'TextArea',
                                                        'SELECT' => 'Select',
                                                        'DATETIME' => 'DATE Time'
                                                        ]
                                        ])


@include('mage2-ecommerce::forms.text',['name' => 'sort_order','label' => 'Sort Order'])




<?php

$pool = 'abcdefghijklmnopqrstuvwxyz';

$randomString = substr(str_shuffle(str_repeat($pool, 6)), 0, 6);

$hiddenClass = "d-none";
$editMode = false;


if (isset($model) && $model->propertyDropdownOptions->count() > 0) {
    $editMode = true;
    $hiddenClass = "";
}
?>

<div class="dynamic-field {{ $hiddenClass }}">

    @if($editMode === true)

        @foreach($model->propertyDropdownOptions as $key => $dropdownOptionModel)

            <div class="dynamic-field-row">
                <div class="form-group col-md-12">
                    <label>Display Text</label>
                    <span class="input-group">
                        <input class="form-control"
                               name="dropdown-options[{{ $dropdownOptionModel->id }}][display_text]"
                               value="{{ $dropdownOptionModel->display_text }}"/>

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

            <div class="form-group col-md-12">
                <label>Display Text</label>

                <span class="input-group">
                    <input disabled class="form-control"
                           name="dropdown-options[{{ $randomString }}][display_text]"/>
                    <span class="input-group-addon  add-field"
                          style='cursor: pointer'>Add</span>
                </span>
            </div>
        </div>

    @endif

    <div class="dynamic-field-row-template d-none">
        <div class="dynamic-field-row">
            <div class="form-group col-md-12">
                <label>Display Text</label>

                <span class="input-group">
                    <input class="form-control"
                           name="dropdown-options[__RANDOM_STRING__][display_text]"/>
                    <span class="input-group-addon  add-field"
                          style='cursor: pointer'>Add</span>
                </span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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

                jQuery(e.target).html('Remove');
                jQuery(e.target).removeClass('add-field');
                jQuery(e.target).addClass('remove-field');
                jQuery(e.target).parents('.dynamic-field-row:first').after(rowTemplate);
            });
            jQuery(document).on('click', '.remove-field', function (e) {

                e.preventDefault();
                jQuery(e.target).parents('.dynamic-field-row:first').remove();

            })
            jQuery('#field_type').on('change', function (e) {

                jQuery('.dynamic-field input').attr('disabled', true);
                jQuery('.dynamic-field').addClass('d-none');
                jQuery('.validate_field').val('');
                jQuery('.validate_field').trigger('change.select2');


                if (jQuery(e.target).val() == "TEXT") {
                    jQuery('.validate_field').val('max:255');
                    jQuery('.validate_field').trigger('change.select2');
                }

                if (jQuery(e.target).val() == "SELECT" && jQuery('.dynamic-field').hasClass('d-none')) {
                    jQuery('.dynamic-field').removeClass('d-none');
                    jQuery('.dynamic-field input').attr('disabled', false);

                }
            })
        });

    </script>
@endpush