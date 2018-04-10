@include('avored-ecommerce::forms.text',['name' => 'name','label' => __('avored-ecommerce::property.name')])
@include('avored-ecommerce::forms.text',['name' => 'identifier','label' => __('avored-ecommerce::property.identifier')])



@include('avored-ecommerce::forms.select',['name' => 'use_for_all_products',
                                            'label' => __('avored-ecommerce::property.use_for_all_products'),
                                            'options' => [
                                                        0 => 'No',
                                                        1 => 'Yes'
                                                        ]
                                        ])


@include('avored-ecommerce::forms.select',['name' => 'data_type',
                                            'label' => __('avored-ecommerce::property.data-type'),
                                            'options' => [
                                                        'VARCHAR' => 'Varchar (Max 255)',
                                                        'DECIMAL' => 'Decimal',
                                                        'TEXT' => 'Text (Big Text e.g Description)',
                                                        'INTEGER' => 'Integer',
                                                        'DATETIME' => 'Date Time',
                                                        'BOOLEAN' => 'Boolean'
                                                        ]
                                        ])


@include('avored-ecommerce::forms.select',['name' => 'field_type',
                                            'label' => __('avored-ecommerce::property.field-type'),
                                            'options' => [
                                                        'TEXT' => 'Text Field',
                                                        'CHECKBOX' => 'Check box',
                                                        'TEXTAREA' => 'TextArea',
                                                        'SELECT' => 'Select',
                                                        'DATETIME' => 'DATE Time'
                                                        ]
                                        ])


@include('avored-ecommerce::forms.text',['name' => 'sort_order','label' => __('avored-ecommerce::property.sort-order')])


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

<div class="dynamic-field mb-4 {{ $hiddenClass }}">

    @if($editMode === true)

        @foreach($model->propertyDropdownOptions as $key => $dropdownOptionModel)

            <div class="dynamic-field-row mt-3">
                <div class="input-group col-md-12">

                    <span class="input-group-prepend">
                        <span class="input-group-text">Display Text</span>
                    </span>

                    <input class="form-control"
                           name="dropdown-options[{{ $dropdownOptionModel->id }}][display_text]"
                           value="{{ $dropdownOptionModel->display_text }}"/>

                    @if ($loop->last)
                        <span class="input-group-append  add-field">
                            <button class="btn btn-outline-secondary">Add</button>
                        </span>
                    @else
                        <span class="input-group-append  remove-field">
                            <button class="btn btn-outline-secondary">Remove</button>
                        </span>
                    @endif


                </div>
            </div>

        @endforeach

    @else

        <div class="dynamic-field-row mt-3">


            <div class="input-group col-md-12">
                    <span class="input-group-prepend">
                        <span class="input-group-text">Display Text</span>
                    </span>

                <input disabled class="form-control"
                       name="dropdown-options[{{ $randomString }}][display_text]"/>
                <span class="input-group-append  add-field"
                      style='cursor: pointer'>
                         <button class="btn btn-outline-secondary" type="button">
                            Add
                        </button>

                    </span>
            </div>

        </div>

    @endif

    <div class="dynamic-field-row-template d-none">
        <div class="dynamic-field-row mt-3">
            <div class="input-group col-md-12">
                <span class="input-group-prepend">
                        <span class="input-group-text">Display Text</span>
                    </span>


                <input class="form-control"
                       name="dropdown-options[__RANDOM_STRING__][display_text]"/>
                <span class="input-group-append  add-field"
                      style='cursor: pointer'>
                        <button class="btn btn-outline-secondary">
                            Add
                        </button>

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