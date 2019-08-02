<div class="price">
    {{ session()->get('default_currency')->symbol }} @{{ parseFloat(price).toFixed(2) }}
</div>
<div class="availability">
    {{ __('Availability') }}: @{{ parseFloat(productQty).toFixed(2) }}
</div>

<form method="post" action="{{ route('add.to.cart') }}">
    @csrf
    @php
    $attributeIds = $product->attributes;
    @endphp
    @foreach ($product->attributes as $attribute)
        <a-form-item
            @if ($errors->has('attributes'))
                validate-status="error"
                help="{{ $errors->first('attributes') }}"
            @endif
            label="{{ $attribute->name }}">
            
            <a-select
                @change="changeAttributeVariable"
                v-decorator="[
                    'attribute-{{ $attribute->id }}',
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('validation.required', ['attribute' => $attribute->name]) }}' 
                            }
                        ]
                    }
                ]">
                @foreach ($product->attributeProductValues()->whereAttributeId($attribute->id)->get() as $attributeValue)
                    <a-select-option
                        key="{{ $attributeValue->id }}"
                        data-product="{{ $attributeValue->variation }}"
                        :value="{{ $attributeValue->id }}">
                        {{ $attributeValue->attributeDropdownOption->display_text }}
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
