
<a-divider><h4 class="mt-1">{{ __('Cart Information') }}</h4></a-divider>

<a-row>
    <a-col :span="4">Image</a-col>
    <a-col :span="8">Name</a-col>
    <a-col :span="4">Qty</a-col>
    <a-col :span="4">Price</a-col>
    <a-col :span="4">Line Total</a-col>
</a-row>
<a-row class="mt-1" :key="item.slug" v-for="item in items">
    <a-col :span="4">
        <a-avatar :style="{width:'50px', height: '50px'}" :src="item.image"></a-avatar>
    </a-col>
    <a-col :span="8">
        <a :href="'/product/' + item.slug">
            @{{item.name}}
        </a>
        <p v-for="attributeInfo in item.attributes">
            @{{ attributeInfo['attribute_name'] }}: @{{ attributeInfo['attribute_dropdown_text'] }}
        </p>
    </a-col>
    <a-col :span="4">@{{ parseFloat(item.qty).toFixed(2) }}</a-col>
    <a-col :span="4">$@{{ parseFloat(item.price).toFixed(2) }}</a-col>
    <a-col :span="4">$@{{ parseFloat((item.qty * item.price) + item.tax).toFixed(2) }}(incl tax)</a-col>
</a-row>
<a-row class="mt-1">
    <a-col :span="8"></a-col>
    <a-col :span="4"></a-col>
    <a-col :span="4"></a-col>
    <a-col :span="4"></a-col>
    <a-col :span="4">
        ${{ Cart::total() }}
    </a-col>
</a-row>
