<?php
$productVariations = $model->productVariations;

dd($productVariations);
?>


<div class="row">

    <div class="col-12">


        @if($attributeOptions !== null && $attributeOptions->count() >= 0)
            <div class="input-group mb-3">

                <select class="form-control attribute-dropdown-element select2" multiple style="width: 88%">
                    @foreach($attributeOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button data-token="{{ csrf_token() }}"
                            class="btn btn-warning use-selected-attribute"
                            type="button">Use Selected
                    </button>
                </div>
            </div>




            <div class="product-variation-wrapper d-none">

                <div class="clearfix mb-3">
                    <a href="#" class="btn add-variant-button float-right  btn-primary">
                        <i class="fa fa-plus"></i> Add Variant
                    </a>
                </div>


                <div class="product-variation-card-wrapper   row">


                </div>

            </div>


        @endif
    </div>

</div>


@push('scripts')
    <script>
        $(function () {


            jQuery('.add-variant-button').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var singleCardHtml = "<div class='col-md-6 mb-3 single-card'>" +
                    jQuery('.product-variation-card-wrapper .single-card:first').html();
                +
                    "</div>";


                jQuery('.product-variation-card-wrapper .single-card:last').after(singleCardHtml);


            });

            jQuery(document).on('click', '.remove-variation-card', function (e) {
                e.preventDefault();
                e.stopPropagation();

                if (jQuery(".single-card").length > 1) {
                    jQuery(this).parents(".single-card:first").remove();
                }
            });


            jQuery('.use-selected-attribute').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var elementValue = jQuery('.attribute-dropdown-element').val();

                var data = {_token: jQuery(this).attr('data-token'), attribute_id: elementValue};


                jQuery.ajax({
                    url: '{{ route('admin.attribute.element') }}',
                    data: data,
                    method: 'post',
                    dataType: 'json',
                    success: function (response) {


                        if (response.success == true) {

                            //jQuery('#add-property').modal('hide');

                            jQuery('.product-variation-card-wrapper').html(response.content);
                            jQuery('.product-variation-wrapper').toggleClass('d-none');


                            //jQuery('.datetime').flatpickr({
                            //    altInput: true,
                            //    altFormat: "d-m-Y",
                            //    dateFormat: "Y-m-d",
                            //});


                        }


                    }
                });


            })
        })


    </script>

@endpush