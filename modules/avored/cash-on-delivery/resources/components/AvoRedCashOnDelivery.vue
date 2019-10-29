<template>
    <div>
        <a-switch @change="handlePaymentChange($event, 'a-cash-on-delivery')">
        </a-switch> 
        Cash On Delivery
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
            EventBus.$emit('selectedPaymentIdentifier', identifier)
        }
    },
    mounted() {        
        var app = this
        var eventBus = EventBus
        eventBus.$on('placeOrderBefore', function() {
            if (app.selectedCashOnDeliveryPaymentOption) {
                eventBus.$emit('placeOrderAfter')
            }
        })
    }
}
</script>
