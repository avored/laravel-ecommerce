<template>
    <div>
        <avored-toggle
            label-text="Cash On Delivery"
            field-name="payment_option"
            toggle-on-value="a-cash-on-delivery"
        ></avored-toggle>
    </div>    
</template>

<script>

export default {
    name: 'avored-cash-on-delivery',
    props: [],
    data () {
        return {
            selectedCashOnDeliveryPaymentOption: false
        }
    },
    methods: {
        handlePaymentChange(checked, identifier) {
            if (checked) {
                this.selectedCashOnDeliveryPaymentOption = true
            } else {
                this.selectedCashOnDeliveryPaymentOption = false
            }
            window.EventBus.$emit('selectedPaymentIdentifier', identifier)
        }
    },
    mounted() {        
        var app = this
        var eventBus = window.EventBus
        eventBus.$on('placeOrderBefore', function() {
            if (app.selectedCashOnDeliveryPaymentOption) {
                eventBus.$emit('placeOrderAfter')
            }
        })
    }
}
</script>
