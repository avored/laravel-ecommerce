<div role="tabcard" class="tab-pane" id="product-attribute">
    <div class="card card-default">
        <div class="card-header">
            <span>Product Specification Attributes </span>
        </div>


        <div class="card-body">

            @foreach($productAttributes as $attribute)

                @if($attribute->field_type == "SELECT")

                    <?php
                    $varcharValue = null;
                    if (isset($product) && $product->id > 0) {

                        $productVarcharValue = $attribute->productVarcharValues()->where('product_id', '=', $product->id)->first();
                        $varcharValue = (isset($productVarcharValue->value)) ? $productVarcharValue->value : NULL;
                    }
                    ?>


                    {!! Form::select('modules[attributes]['.$attribute->identifier.']',
                                    $attribute->title,
                                    $attribute->attributeDropdownOptions->pluck('display_text','id'),
                                    ['value' => $varcharValue,'class' => 'form-control']
                                    ) !!}
                @endif

                @if($attribute->field_type == "TEXT")


                        <?php
                        $varcharValue = null;
                        if (isset($product) && $product->id > 0) {

                            $productVarcharValue = $attribute->productVarcharValues()->where('product_id', '=', $product->id)->first();
                            $varcharValue = (isset($productVarcharValue->value)) ? $productVarcharValue->value : NULL;
                        }
                        ?>

                    {!! Form::text('modules[attributes]['.$attribute->identifier.']',
                                    $attribute->title,
                                    ['value' => $varcharValue,'class' => 'form-control']
                                    ) !!}
                @endif


            @endforeach

        </div>

    </div>


</div>