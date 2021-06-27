
<div><h4 class="text-lg text-red-700 font-semibold my-5">{{ __('avored.cart_information') }}</h4></div>

<div class="flex">
    <div class="w-1/6">Image</div>
    <div class="w-2/6">Name</div>
    <div class="w-1/6">Qty</div>
    <div class="w-1/6">Price</div>
    <div class="w-1/6">Line Total</div>
</div>
<div class="flex items-center" :key="item.slug" v-for="item in items">
    <div class="w-1/6">
        <img :style="{width:'50px', height: '50px'}" :src="item.image"></img>
    </div>
    <div class="w-2/6">
        <a :href="'/product/' + item.slug">
            @{{item.name}}
        </a>
        <p v-for="attributeInfo in item.attributes">
            @{{ attributeInfo['attribute_name'] }}: @{{ attributeInfo['attribute_dropdown_text'] }}
        </p>
    </div>
    <div class="w-1/6">@{{ parseFloat(item.qty).toFixed(2) }}</div>
    <div class="w-1/6">{{ session()->get('default_currency')->symbol }}@{{ parseFloat(item.price).toFixed(2) }}</div>
    <div class="w-1/6">{{ session()->get('default_currency')->symbol }}@{{ parseFloat((item.qty * item.price) + item.tax).toFixed(2) }}</div>
    
</div>
@if(Cart::discount() > 0)
    <div class="flex items-center">
        <div class="w-1/6"></div>
        <div class="w-2/6"></div>
        <div class="w-1/6"></div>
        <div class="w-1/6">Discount</div>
        <div class="w-1/6">
            - {{ session()->get('default_currency')->symbol }}{{ Cart::discount() }}
        </div>
    </div>
@endif
<div class="flex items-center">
    <div class="w-1/6"></div>
    <div class="w-2/6"></div>
    <div class="w-1/6"></div>
    <div class="w-1/6">Total</div>
    <div class="w-1/6">
        {{ session()->get('default_currency')->symbol }}{{ Cart::total() }}
    </div>
</div>
