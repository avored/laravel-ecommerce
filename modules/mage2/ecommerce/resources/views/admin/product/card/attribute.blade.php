<?php
$productVariations = $model->productVariations;
$productAttributes = $model->getProductAllAttributes();
?>


<div class="row">

    <div class="col-12">


        @if($attributeOptions !== null && $attributeOptions->count() >= 0)

            <div class="input-group mb-3">

                <select class="select2 attribute-dropdown-element  form-control" multiple name="attribute_selected[]"
                        style="width: 100%">
                    @foreach($attributeOptions as $value => $label)
                        <option
                                @if($productAttributes->contains('attribute_id',$value))
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
                @foreach($model->variations as $variation)
                <tr>
                    <th scope="row">{{ $variation->variationProduct->id }}</th>
                    <td>{{ $variation->variationProduct->name }}</td>
                    <td>{{ $variation->variationProduct->price }}</td>
                    <td>{{ $variation->variationProduct->qty }}</td>
                    <td><a href="#">Edit</a></td>
                    <td><a href="#">Destroy</a></td>
                </tr>
                @endforeach

                </tbody>

            </table>

        @endif
    </div>

</div>


@push('scripts')
    <script>
        $(function () {


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