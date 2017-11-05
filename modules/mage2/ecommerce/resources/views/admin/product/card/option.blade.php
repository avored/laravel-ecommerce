<div class="row">
    <div class="col-12">

        <ul class="nav nav-tabs" id="product-option-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"
                   id="product-option-tab" data-toggle="tab"
                   href="#product-option"
                   role="tab">
                    PRODUCT OPTIONS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   id="product-option-combination-tab"
                   data-toggle="tab"
                   href="#product-option-combination"
                   role="tab">

                    PRODUCT OPTION COMBINATION
                </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active"
                 id="product-option"
                 role="tabpanel">

                <div class="mt-3 col-12">

                    <div class="h3">Product Option</div>


                    @if(!isset($optionValues))
                        <?php $optionValues = []; ?>
                    @endif
                    <div class="form-group">
                        <div class="input-group">
                            <select id="option_id" multiple class="product-options form-control" name="option_id[]">
                                @foreach($productOptions as $val => $lab)
                                    <option
                                            @if(in_array($val, $optionValues))
                                            selected
                                            @endif
                                            value="{{ $val }}">{{ $lab }}</option>
                                @endforeach
                            </select>
                            <button type="button" style="cursor: pointer" class="input-group-addon use-this-option" >Use This</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="product-option-combination" role="tabpanel"
                 aria-labelledby="product-option-combination">
                <div class="mt-3">
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <span class="h5" style="line-height: 1.5">Option Combinations Grid</span>

                                <span class="float-right">
                                    <a href="#"
                                       data-csrf="{{ csrf_token() }}"
                                       data-product-id="{{ $model->id }}"
                                       class="btn btn-sm create-option-combination-btn btn-warning">
                                        Create Option Combination
                                    </a>
                                </span>
                            </div>

                            <div class="card-body">
                                <p> Sorry no Possible Options Available Now</p>

                                <table class="table table-hover">
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>SKU</th>
                                        <th>Price Variations</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Color-BLUE-SIZE-10</td>
                                        <td>php-shirt-blue-10</td>
                                        <td>+10</td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@push('scripts')
    <script>
        $(function () {
            $('.product-options').select2({width: '100%'});
            $('.use-this-option').click(function (e) {
                $('#product-option-tabs a[href="#product-option-combination"]').tab('show');

            });

            $('.create-option-combination-btn').click(function (e) {
                if (jQuery('#option-combination-modal').length <= 0) {
                    var data = {_token: $(this).attr('data-csrf'),
                                options: jQuery('#option_id').val(),
                                'product_id' : jQuery(this).attr('data-product-id')
                                };
                    $.ajax({
                        method: 'post',
                        url : '{{ route('admin.option.combination') }}',
                        data: data,
                        success: function (result) {
                            jQuery('body').append(result);
                            jQuery('#option-combination-modal').modal('show');
                            //console.info(result);
                        }

                    });
                } else {

                    jQuery('#option-combination-modal').modal('show');

                }



            });
        })
    </script>
@endpush