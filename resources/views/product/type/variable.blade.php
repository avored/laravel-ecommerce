<div class="price">
    {{ session()->get('default_currency')->symbol }} @{{ parseFloat(price).toFixed(2) }}
</div>
<div class="availability">
    {{ __('Availability') }}: @{{ parseFloat(productQty).toFixed(2) }}
</div>

<form method="post" action="{{ route('add.to.cart') }}">
    @csrf
    @php
    //$attributeIds = $product->attributes;
    $attributeGroups = $product->getVariationByAttributeGroup();
    @endphp
    @foreach ($attributeGroups as $attributeId => $variations)
        <?php 
        $attribute = $product->getAttributeById($attributeId);

        ?>

        
            <a-form-item
                @if ($errors->has('attributes'))
                    validate-status="error"
                    help="{{ $errors->first('attributes') }}"
                @endif
                label="{{ $attribute->name }}">
                <a-select
                    @change="changeAttributeVariable"
                    v-decorator="[
                        'attribute-{{ $attributeId }}',
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('validation.required', ['attribute' => $attribute->name]) }}' 
                                }
                            ]
                        }
                    ]">
                    @foreach ($variations as $variation)
                        <a-select-option
                            key="{{ $variation->id }}"
                            data-product="{{ $variation->variation }}"
                            :value="{{ $variation->id }}">
                            {{ $variation->attributeDropdownOption->display_text }}
                        </a-select-option>           
                    @endforeach
                </a-select>
            </a-form-item>
    @endforeach
    <div class="hidden-attributes">
        <input 
            type="hidden" 
            :name="'attributes[' + index + ']'"
            v-for="(attributeValueId, index) in attributes"
            :value="attributeValueId" />
    </div>
    
    <a-input-number :min="1" :default-value="1" @change="changeQty" name="qty"></a-input-number>
    <a-button html-type="submit" type="primary">
        <a-icon type="shopping_cart"></a-icon>
        Add To Cart
    </a-button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
    <input type="hidden" name="qty" v-model="qty" />
</form>
