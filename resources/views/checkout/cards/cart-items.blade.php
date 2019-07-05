
<a-divider><h4 class="mt-1">{{ __('Cart Information') }}</h4></a-divider>

<a-list
    item-layout="vertical"
    size="large"
    :data-source="{{ Cart::toArray() }}">
    <div slot="footer" :style="{'font-size': '1.0rem',float:'right'}">
        {{ __('Total:')}} ${{ Cart::total() }}
    </div>
    <a-list-item slot="renderItem" slot-scope="item, index" key="item.name">
        <a-list-item-meta>
            <div slot="description">
                <a-row>
                    <a-col :span="12">
                        @{{item.name}}
                    </a-col>
                    <a-col :span="4">
                        @{{ parseFloat(item.qty).toFixed(2) }}
                    </a-col>
                    <a-col :span="3">
                        $@{{ parseFloat(item.price).toFixed(2) }}
                    </a-col>
                    <a-col :span="5" :style="{'text-align':'right'}">
                        $@{{ parseFloat(item.qty * item.price).toFixed(2) }}
                    </a-col>
                </a-row>
            </div>
            <a-avatar slot="avatar" :style="{width:'70px', height: '70px'}" :src="item.image" />
        </a-list-item-meta>
    </a-list-item>
</a-list>
