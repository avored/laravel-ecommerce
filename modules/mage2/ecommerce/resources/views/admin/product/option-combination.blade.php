<div class="modal" id="option-combination-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="post" enctype="multipart/form-data" action="{{ route('admin.product.option-combination.update') }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Option Combination</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    {{ csrf_field() }}

                @foreach($options as $option)

                    @if($option->field_type == 'SELECT')

                        <div class="form-group">
                            <label for="option-{{ $option->id }}">{{ $option->name }}</label>

                            <select name="attributes_specification[{{ $option->id  }}]"
                                    class="form-control"
                                    id=option-{{ $option->id }}">

                                <option value="">Please Select</option>
                                @foreach($option->attributeDropdownOptions as $dropdown)

                                    <option
                                            value="{{ $dropdown->id }}">{{ $dropdown->display_text }}</option>
                                @endforeach
                            </select>

                        </div>
                    @endif

                @endforeach


                <div class="row">
                    <div class="col-6">
                        @include('mage2-ecommerce::forms.text',['name' => 'sku','label' => 'Sku'])
                    </div>
                    <div class="col-6">
                        @include('mage2-ecommerce::forms.text',['name' => 'qty','label' => 'Qty'])

                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        @include('mage2-ecommerce::forms.text',['name' => 'price','label' => 'Price Variation'])

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                    </div>
                </div>








                <!--
                NAME, SKU, IDENTIFIER, PRICE VARIATION, IMAGE, QTY,

                -->


                <input type="hidden" value="{{ $productId }}" name="product_id">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>