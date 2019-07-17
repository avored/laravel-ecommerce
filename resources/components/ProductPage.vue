<script>
import isNil from 'lodash/isNil';

export default {
    data() {
        return {
            qty: 1,
            attributes: {}
        }
    },
    methods: {
        changeQty(value) {
            this.qty = value
        },
        changeAttributeVariable(value) {
            if (isNil(this.attributes['attribute_value_id'])) {
                this.attributes['attribute_value_id'] = [];
            }
            this.attributes['attribute_value_id'].push(value);
            console.log(value);
        }
    }
}
</script>
