<div role="tabpanel" class="tab-pane" id="product-attribute">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>Product Specification Attributes </span>
        </div>


        <div class="panel-body">

            <table class="table table-responsive table-bordered">

                @foreach($productAttributes as $attribute)
                    <?php
                    $varcharValue = null;
                    if (isset($product) && $product->id > 0) {
                        $productVarcharValue = $attribute->productVarcharValues()->where('product_id', '=', $product->id)->first();
                        $varcharValue = (isset($productVarcharValue->value)) ? $productVarcharValue->value : NULL;
                    }
                    ?>
                    @if(!empty($varcharValue))
                        <tr>
                            <th>
                                {{ $attribute->title }}
                            </th>
                            <td>
                                {{ $varcharValue }}
                            </td>
                        </tr>
                    @endif
                @endforeach

            </table>
        </div>

    </div>


</div>