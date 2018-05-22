<?php
$productVariations = $model->attribute;

$attributeOptions = $model->getAttributeOptions();

?>


<div class="row">

    <div class="col-12">


        @if($attributeOptions !== null && $attributeOptions->count() >= 0)

            <div class="input-group mb-3">

                <select class="select2 attribute-dropdown-element  form-control" multiple name="attribute_selected[]"
                        style="width: 80%">
                    @foreach($attributeOptions as $value => $label)
                        <option
                                @if($productVariations->contains('id',$value))
                                selected
                                @endif

                                value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <button data-token="{{ csrf_token() }}" data-product-id="{{ $model->id }}"
                            class="btn btn-warning use-selected-attribute"
                            type="button">Use Selected
                    </button>
                </div>

            </div>

            <div class="product-variation-card-wrapper   row"></div>

            @if(null != $model->productVariations)

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Destroy</th>


                    </tr>
                    </thead>
                    <tbody>


                    @foreach($model->productVariations as $variation)
                        <tr>
                            <th scope="row">{{ $variation->variationProduct->id }}</th>
                            <td>{{ $variation->variationProduct->name }}</td>
                            <td>{{ $variation->variationProduct->price }}</td>
                            <td>{{ $variation->variationProduct->qty }}</td>
                            <td>
                                <a href="#"
                                   data-token="{{ csrf_token() }}"
                                   class="edit-variation-link"
                                   data-variation-id="{{ $variation->variationProduct->id }}">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="#"
                                        class="product-variation-delete-link"
                                        data-csrf="{{ csrf_token() }}"
                                        data-method="delete"
                                        data-url="{{ route('admin.product.destroy', $variation->variationProduct->id) }}"
                                    >
                                    Destroy
                                </a>
                               
                            </td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>

            @endif

        @endif
    </div>

</div>


@push('scripts')
    <script>
        $(function () {


            jQuery(document).on('click','.product-variation-delete-link',function(e) {
                e.preventDefault();
                e.stopPropagation();

                var data = {'_method': jQuery(this).attr('data-method'),'_token' : jQuery(this).attr('data-csrf')};
                var url = jQuery(this).attr('data-url');

                jQuery.ajax({
                    type: "POST",
                    url: url,
                    data:data,
                    success: function(response) {
                        location.reload();
                    }

                });
            });
            jQuery(document).on('click', '.edit-variation-link', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var variationId = jQuery(this).attr('data-variation-id');

                if (jQuery('#variation-modal-' + variationId).length > 0) {

                    jQuery('#variation-modal-' + variationId).modal();

                } else {

                    var data = {_token: jQuery(this).attr('data-token'), variation_id: variationId};
                    jQuery.ajax({
                        url: '{{ route('admin.variation.edit') }}',
                        data: data,
                        method: 'post',
                        dataType: 'json',
                        success: function (response) {

                            if (response.success == true) {

                                jQuery(document.body).append(response.content);
                                jQuery(response.modalId).modal();
                            }
                        }
                    });
                }


            })
            jQuery(document).on('click', '.remove-option', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (jQuery(this).parents('.option-tag-list:first').find('.single-option').length > 1) {
                    jQuery(this).parents(".single-option:first").remove();
                } else {
                    alert('You cannot remove all possible Options');
                }
            });
            jQuery('.use-selected-attribute').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                var elementValue = jQuery('.attribute-dropdown-element').val();
                var productId = jQuery(this).attr('data-product-id');
                var data = {_token: jQuery(this).attr('data-token'), attribute_id: elementValue, product_id: productId};
                jQuery.ajax({
                    url: '{{ route('admin.attribute.element') }}',
                    data: data,
                    method: 'post',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            jQuery('.product-variation-card-wrapper').html(response.content);
                            jQuery('.product-variation-wrapper').toggleClass('d-none');
                        }
                    }
                });
            });


        });


    </script>

@endpush