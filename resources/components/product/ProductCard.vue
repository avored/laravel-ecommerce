<template>
    <a-card hoverable class="product-card">
        <a slot="cover" :href="productPageUrl">
            <img
            :alt="product.name"
            class="main-image"
            :src="product.main_image_url"
            />
        </a>
        <template class="ant-card-actions" slot="actions">
            <form slot="title" method="post" :action="addToCartUrl">
                <input type="hidden" name="_token" :value="token"/>
                <a-button html-type="submit" type="primary" icon="shopping-cart"></a-button>
                <input type="hidden" name="slug" :value="product.slug" />
                <input type="hidden" name="qty" value="1" />
            </form>
            
            <form slot="title" method="post" :action="getWishlistUrl()">
                <input type="hidden" name="_token" :value="token"/>
                <a-button html-type="submit" type="default" icon="heart">
                    {{ getWishlistLabel() }}
                </a-button>
                <input type="hidden" name="slug" :value="product.slug" />
            </form>
               
        </template>
        <a :href="productPageUrl">
            <h3>{{ product.name }}</h3>
            <div class="price">
                {{ currency }}{{ parseFloat(product.price).toFixed(2) }}
            </div>
        </a>
    </a-card>
</template>
<script>
export default {
    props: ['product', 'addToCartUrl', 'currency', 'productPageUrl', 'addToWishlist', 'removeFromWishlist', 'userWishlists'],
    data() {
        return {
            token: null
        }
    },
    mounted() {
        this.token = document.head.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        getWishlistUrl() {
            var app = this;
            const userWishlistHasProduct = this.userWishlists.find(ele => {
                return ele.product_id === app.product.id
            })
            if (this.userWishlists.length === 0) {
                return this.addToWishlist;
            }
            if (userWishlistHasProduct) {
                return this.removeFromWishlist
            } else {
                return this.addToWishlist;   
            }
        },
        getWishlistLabel() {
            var app = this;
            const userWishlistHasProduct = this.userWishlists.find(ele => {
                return ele.product_id === app.product.id
            })
            if (this.userWishlists.length === 0) {
                return 'Add'
            }
            if (userWishlistHasProduct) {
                return 'Remove'
            } else {
                return 'Add';   
            }
        },
    }
}
</script>
