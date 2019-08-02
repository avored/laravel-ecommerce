<script>
import isNil from 'lodash/isNil';

export default {
    props: ['product'],
    data() {
        return {
            qty: 1,
            attributes: {},
            price: 0,
            productQty: 0
        }
    },
    methods: {
        changeQty(value) {
            this.qty = value
        },
        changeAttributeVariable(value, $event) {
            var variableProduct = JSON.parse($event.data.attrs['data-product']);
            this.price = variableProduct['price'];
            this.productQty = variableProduct['qty'];
            if (isNil(this.attributes['attribute_value_id'])) {
                this.attributes['attribute_value_id'] = [];
            }
            this.attributes['attribute_value_id'].push(value);
        }
    },
    mounted() {
        this.price = this.product['price'];
        this.productQty = this.product['qty'];
    }
}
</script>
