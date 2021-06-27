<div class="price">
    {{ session()->get('default_currency')->symbol }} @{{ parseFloat(price).toFixed(2) }}
</div>
<div class="availability">
    {{ __('Availability') }}: @{{ parseFloat(productQty).toFixed(2) }}
</div>

<form method="post" action="{{ route('add.to.cart') }}">
    @csrf
    @php
        $attributeGroups = $product->getVariationByAttributeGroup();
    @endphp
    @foreach ($attributeGroups as $attributeId => $variations)
        @php
            $attribute = $product->getAttributeById($attributeId);
        @endphp
        @if ($attribute->display_as === 'IMAGE')
            <a-form-item
              
                label="{{ $attribute->name }}">
                <a-radio-group
                    ref="attribute-{{ $attributeId }}"
                    data-attribute="{{ json_encode($attributeGroups->get($attributeId)) }}"
                    data-attribute-length="{{ $attributeGroups->count() }}"
                    @change="changeAttributeVariable">
                    @foreach ($attribute->dropdownOptions as $dropdownOption)
                        <a-radio key="{{ $dropdownOption->id }}"
                            value="{{ json_encode(['attribute_id' => $attributeId, 'attribute_dropdown_option_id' => $dropdownOption->id]) }}"
                        >
                            <img style="width:25px;height:25px" 
                                src="{{ '/storage/' . $dropdownOption->path }}"></img>
                        </a-radio>
                    @endforeach
                </a-radio-group>
            <div class="hidden-attributes">
                <input 
                    type="hidden" 
                    :name="'attributes[' + index + ']'"
                    v-for="(attributeValueId, index) in attributes"
                    :value="attributeValueId" />
            </div>
            </a-form-item>
        @else
            <a-form-item
                @if ($errors->has('attributes'))
                    validate-status="error"
                    help="{{ $errors->first('attributes') }}"
                @endif
                label="{{ $attribute->name }}">
                <a-select
                    ref="attribute-{{ $attributeId }}"
                    data-attribute="{{ json_encode($attributeGroups->get($attributeId)) }}"
                    data-attribute-length="{{ $attributeGroups->count() }}"
                    :key="{{ $attribute->id }}"
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
                    @foreach ($attribute->dropdownOptions as $dropdownOption)
                        <a-select-option
                            key="{{ $dropdownOption->id }}"
                            value="{{ json_encode(['attribute_id' => $attributeId, 'attribute_dropdown_option_id' => $dropdownOption->id]) }}">
                            {{ $dropdownOption->display_text }}
                        </a-select-option>           
                    @endforeach
                </a-select>
            </a-form-item>
        @endif
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
        {{__('avored.add_to_cart')}}
    </a-button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
    <input type="hidden" name="qty" v-model="qty" />
</form>

<?php 
    $wishlistRepository = app(\AvoRed\Wishlist\Database\Contracts\WishlistModelInterface::class);
    $customer = auth()->guard('customer')->user();
?>
@if (($customer === null) ||  !($customer && $wishlistRepository->customerHasProduct($customer, $product->id)))

<form method="post" class="pb-5 w-40" action="{{ route('wishlist.store') }}">
    @csrf
    <button class="text-white mt-5 px-4 bg-gray-500 border-0 py-2 
        focus:outline-none hover:bg-gray-700 leading-7 rounded text-xs">
            {{ __('avored.add_to_wishlist') }}
    </button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
</form>
@else 
<form method="post" class="pb-5 w-56" action="{{ route('wishlist.destroy') }}">
    @csrf
    <button class="text-white mt-5 px-4 bg-gray-500 border-0 py-2 
        focus:outline-none hover:bg-gray-700 leading-7 rounded text-xs">
            {{ __('avored.remove_to_wishlist') }}
    </button>
    <input type="hidden" name="slug" value="{{ $product->slug }}" />
</form>
@endif

</div>
