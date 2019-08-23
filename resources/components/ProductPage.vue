<script>
import isNil from 'lodash/isNil';

export default {
    props: ['product'],
    data() {
        return {
            qty: 1,
            attributes: {},
            price: 0,
            productQty: 0,
            productMainImage: ''
        }
    },
    methods: {
        changeQty(value) {
            this.qty = value
        },
        changeAttributeVariable(value) {
            var variableProduct = {};
            if (!isNil(value.target.value)) {
                variableProduct = JSON.parse(value.target.value)
            } else {
                variableProduct = value;
            }
            this.price = variableProduct['price'];
            this.productQty = variableProduct['qty'];
            variableProduct.images.forEach(image => {
                if (!isNil(image.is_main_image) && image.is_main_image == 1) {
                    this.productMainImage = '/storage/'+ image.path
                }
            })

            if (isNil(this.attributes['attribute_product_value_id'])) {
                this.attributes['attribute_product_value_id'] = [];
            }
            this.attributes['attribute_product_value_id'] = variableProduct.id;
        }
    },
    mounted() {
        this.price = this.product['price'];
        this.productQty = this.product['qty'];
        this.product.images.forEach(image => {
            if (!isNil(image.is_main_image) && image.is_main_image == 1) {
                this.productMainImage = '/storage/'+ image.path
            }
        })
        
    }
}
</script>
