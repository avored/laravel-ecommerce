<div class="card card-default">
    <div class="card-header">
        <span>EXTRA Attributes </span>
    </div>


    <div class="card-body">
        @foreach($extraAttributes as $attribute)

            <?php
            $varcharValue = null;
            if (isset($product) && $product->id > 0) {
                $productVarcharValue = $attribute->productVarcharValues()->where('product_id', '=', $product->id)->first();
                $varcharValue = (isset($productVarcharValue->value)) ? $productVarcharValue->value : NULL;
            }
            ?>

            @if($attribute->field_type == "SELECT")
                {!! Form::select('modules[attributes]['.$attribute->identifier.']',
                                $attribute->title,
                                $attribute->attributeDropdownOptions->pluck('display_text','id'),
                                ['value' => $varcharValue,'class' => 'form-control']
                                ) !!}
            @endif


        @endforeach

    </div>

</div>

