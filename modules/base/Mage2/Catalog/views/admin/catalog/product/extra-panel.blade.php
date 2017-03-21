<div class="panel panel-default">
    <div class="panel-heading">
        <span>EXTRA Attributes </span>
    </div>


    <div class="panel-body">
        @foreach($extraAttributes as $attribute)
            
            <?php
            $varcharValue = null;
            if(isset($product) && $product->id > 0) {
                $productVarcharValue = $attribute->productVarcharValues()->where('product_id','=', $product->id)->first();
                $varcharValue = $productVarcharValue->value;
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

