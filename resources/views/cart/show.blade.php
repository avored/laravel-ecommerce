@extends('layouts.app')

@section('content')
    <?php 
    //dd(Cart::toArray());
    ?>
    <cart-page inline-template>
        <a-list
            item-layout="vertical"
            size="large"
            :data-source="{{ Cart::toArray() }}">
            <div slot="footer" :style="{'font-size': '1.3rem',float:'right'}">
                ${{ Cart::total() }}
            </div>
            <a-list-item slot="renderItem" slot-scope="item, index" key="item.name">
                <template slot="actions" v-for="{type, text} in actions">
                    <span :key="type">
                        <a-icon onclick="window.alert('@todo')" :type="type" style="margin-right: 8px"></a-icon>
                    </span>
                </template>
               
                <a-list-item-meta>
                    <div slot="title">
                        <a-row>
                            <a-col :span="12">
                                <a :href="'/product/' + item.slug">
                                    @{{item.name}}
                                </a>
                                <p v-for="attributeInfo in item.attributes">
                                    @{{ attributeInfo['attribute_name'] }}: @{{ attributeInfo['attribute_dropdown_text'] }}
                                </p>
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
                    <a-avatar slot="avatar" :style="{width:'100px', height: '100px'}" :src="item.image" />

                </a-list-item-meta>
            </a-list-item>
        </a-list>
    </cart-page>
@endsection
