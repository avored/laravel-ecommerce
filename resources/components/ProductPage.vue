<script>
import isNil from 'lodash/isNil';
import isEqual from 'lodash/isEqual'

export default {
    props: ['product', 'variations'],
    data() {
        return {
            qty: 1,
            attributes: {},
            price: 0,
            productQty: 0,
            productMainImage: '',
            selectedAttributes: {}
        }
    },
    methods: {
        changeQty(value) {
            this.qty = value
        },
        attributeDropdownOption(val) {
            console.log(val);

            return 'attribute_dropdown_option_' + val;
        },
        checkIfSameVariation(variations) {
            var comparableVariation = {};
            variations.forEach(variation => {
                if (isNil(comparableVariation[variation['attribute_id']])) {
                    comparableVariation[variation['attribute_id']] = {}
                }
                comparableVariation[variation.attribute_id] = variation.attribute_dropdown_option_id
            })
            return isEqual(comparableVariation, this.selectedAttributes)
        },
        changeAttributeVariable(value) {
            if (!isNil(value.target)) {
                value = value.target.value
            }
            var attributeValue = JSON.parse(value)
            var attributeRef = this.$refs['attribute-' + attributeValue.attribute_id]
            var attributeLength = JSON.parse(attributeRef.$attrs['data-attribute-length'])
            var app = this;
            this.selectedAttributes[attributeValue['attribute_id']] = attributeValue['attribute_dropdown_option_id']
            var selectedVariationId = null
            var selectedVariation = null
            if (Object.keys(this.selectedAttributes).length === attributeLength) {
                Object.keys(app.variations).forEach(key => {
                    var variation = app.variations[key];
                    var result = app.checkIfSameVariation(variation);
                    if (result) {
                        selectedVariationId = key
                        selectedVariation = variation[0].variation   
                    }
                })
                this.price = selectedVariation.price;
                this.productQty = selectedVariation['qty'];
                selectedVariation.images.forEach(image => {
                    if (!isNil(image.is_main_image) && image.is_main_image == 1) {
                        this.productMainImage = '/storage/'+ image.path
                    }
                })

                if (isNil(this.attributes['attribute_product_value_id'])) {
                    this.attributes['attribute_product_value_id'] = [];
                }
                this.attributes['attribute_product_value_id'] = selectedVariation.id;
            }
           
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
